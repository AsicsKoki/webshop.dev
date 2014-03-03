<?php
class PaymentQueue {

    public function fire($job, $data)
    {
		// ### CreditCard
		// A resource representing a credit card that can be
		// used to fund a payment.
		$card = Paypalpayment::CreditCard();
		$card->setType($type);
		$card->setNumber($creditCardNumber);
		$card->setExpire_month($expireMonth);
		$card->setExpire_year($expireYear);
		$card->setCvv2($cvv2);
		$card->setFirst_name($firstName);
		$card->setLast_name($lastName);

		// ### FundingInstrument
		// A resource representing a Payer's funding instrument.
		// Use a Payer ID (A unique identifier of the payer generated
		// and provided by the facilitator. This is required when
		// creating or using a tokenized funding instrument)
		// and the `CreditCardDetails`
		$fi = Paypalpayment::FundingInstrument();
		$fi->setCredit_card($card);

		// ### Payer
		// A resource representing a Payer that funds a payment
		// Use the List of `FundingInstrument` and the Payment Method
		// as 'credit_card'
		$payer = Paypalpayment::Payer();
		$payer->setPayment_method("credit_card");
		$payer->setFunding_instruments(array($fi));

		// ### Amount
		// Let's you specify a payment amount.
		$amount = Paypalpayment:: Amount();
		$amount->setCurrency("USD");
		$amount->setTotal($total);

		// ### Transaction
		// A transaction defines the contract of a
		// payment - what is the payment for and who
		// is fulfilling it. Transaction is created with
		// a `Payee` and `Amount` types
		$transaction = Paypalpayment:: Transaction();
		$transaction->setAmount($amount);
		$transaction->setDescription("This is the payment description.");

		// ### Payment
		// A Payment Resource; create one using
		// the above types and intent as 'sale'
		$payment = Paypalpayment:: Payment();
		$payment->setIntent("sale");
		$payment->setPayer($payer);
		$payment->setTransactions(array($transaction));

		// ### Create Payment
		// Create a payment by posting to the APIService
		// using a valid ApiContext
		// The return object contains the status;
		try {
			$payment->create($this->_apiContext);
		} catch (\PPConnectionException $ex) {
			return "Exception: " . $ex->getMessage() . PHP_EOL;
			var_dump($ex->getData());
			exit(1);
		}

		$response=$payment->toArray();

		echo"<pre>";
		print_r($response);

		//var_dump($payment->getId());

		//print_r($payment->toArray());//$payment->toJson();
		}
    }

}