<?php

class PaypalPaymentController extends BaseController {

    /**
     * object to authenticate the call.
     * @param object $_apiContext
     */
    private $_apiContext;

    /**
     * Set the ClientId and the ClientSecret.
     * @param
     *string $_ClientId
     *string $_ClientSecret
     */
    private $_ClientId='AbAl5hD4c2zyurExqyCDLnDpk5snS-qd7q7Y3RwqwB9r4uL_TskIHdg_VGTc';
    private $_ClientSecret='EFQgdxAiBDDwkg_J83KxGEhC1_q7Ri6N9W4PoXlXHKtRhECCPElPxCZp4VJ-';

    /*
     *   These construct set the SDK configuration dynamiclly, 
     *   If you want to pick your configuration from the sdk_config.ini file
     *   make sure to update you configuration there then grape the credentials using this code :
     *   $this->_cred= Paypalpayment::OAuthTokenCredential();
    */
    public function __construct()
    {
        // ### Api Context
        // Pass in a `ApiContext` object to authenticate 
        // the call. You can also send a unique request id 
        // (that ensures idempotency). The SDK generates
        // a request id if you do not pass one explicitly. 

        $this->_apiContext = Paypalpayment:: ApiContext(
            Paypalpayment::OAuthTokenCredential(
                $this->_ClientId,
                $this->_ClientSecret
            )
        );
    }

       /*
     * Create payment using credit card
     * url:payment/create
    */
    public function create()
    {

        $data = Session::all();
        var_dump($data);
        exit;



        $type = Input::get('creditCardType');
        $creditCardNumber = Input::get('creditCardNumber');
        $cvv2 = Input::get('creditCardSecurityNumber');
        $expireMonth = Input::get('creditCardExpiryMonth');
        $expireYear = Input::get('creditCardExpiryYear');
        $firstName = Input::get('firstName');
        $lastName = Input::get('lastName');
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
        $amount->setTotal("1.00");

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

    /*
        Use this call to get a list of payments. 
        url:payment/
    */
    public function index()
    {
        echo "<pre>";

        $payments = Paypalpayment::all(array('count' => 1, 'start_index' => 0),$this->_apiContext);

        print_r($payments);
    }

        /*
        Use this call to get details about payments that have not completed, 
        such as payments that are created and approved, or if a payment has failed.
        url:payment/PAY-3B7201824D767003LKHZSVOA
    */

    public function show($payment_id)
    {
        $payment_id = "PAY-3RM7991580237541DKMDAY3Y";
       $payment = Paypalpayment::get($payment_id,$this->_apiContext);

       echo "<pre>";

       print_r($payment);
    }

}