<?php
/**
Add Credit Based on Payment Processor Hook for WHMCS
Version 1.0 by KuJoe (JMD.cc)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
**/

function invoiceAddCredit($vars) {
	$percent = '15'; //Set percentage here
	$payproc = 'bitpay'; //Set payment processor here (bitpay is default)
	$minpay = '0.00'; //Set minimum payment amount to receive credit here
	$desc = 'Credit for paying with BitPay'; //Edit the description to whatever you'd like
	$adminuser = "ADMINUSER"; //Edit the admin user to which ever you like, make sure it's valid in WHMCS since this is required
	
	$invoice = $vars['invoiceid'];
	$result = select_query('tblinvoices', '', array("id" => $invoice));
	$data = mysql_fetch_assoc($result);
	if ($data['paymentmethod'] == $payproc AND isset($data['total']) AND $data['total'] > $minpay) {
		$amount = ($percent / 100) * $data['total'];
		$command = "addcredit";
		$values = array( 'clientid' => $data['userid'], 'description' => $desc, 'amount' => $amount  );
		$results = localAPI($command, $values, $adminuser);
		if ($results['result'] != "success") {
			logActivity('An Error Occurred: '.$results['result']);
		}
	}
}

add_hook("InvoicePaid",1,"invoiceAddCredit");
?>