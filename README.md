Add Credit Based on Payment Processor Hook for WHMCS<br />
Version 1.0 by KuJoe (JMD.cc)<br />
	
//Requirements:<br />
WHMCS 5.3.x (Tested with 5.3.12 and newer)<br />

//Installation:<br />
1) Edit the invoiceAddCredit.php file and then upload it into your WHMCS's hooks directory (/includes/hooks/).<br />

//Required:<br />
A) Edit $percent to set the percentage of the total invoice to be added as a credit to the account (15% is default).<br />
B) Edit $payproc to set the payment processor you want to issue the credit on their account (bitpay is default).<br />
C) Edit $desc to set the description that appears in the credit to whatever you'd like.<br />
D) Edit $adminuser to set the admin user that the credit is issued under (make sure it's valid in WHMCS since this is required).<br />

//Optional:<br />
A) Edit $minpay if you want to set a minimum invoice total required before a credit is added (this can by helpful to filter by billing cycle, default is 0.00).<br />