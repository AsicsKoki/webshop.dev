<form name="creditCardForm" novalidate ng-submit="sendPayment()" ng-app ng-controller="creditCardController">
	<fieldset>
		<div class="form-group">
			<label for="inputFirstName">First name</label>
			<input type="text" name="firstName" ng-model="data.firstName" class="form-control" id="inputFirstName" ng-minlength=2 required placeholder="First name">
			<div class="error" ng-show="creditCardForm.firstName.$dirty && creditCardForm.firstName.$invalid">
				<small class="error"
				ng-show="creditCardForm.firstName.$error.required">
					Enter your first name.
				</small>
				<small class="error" ng-show="creditCardForm.firstName.$error.minlength">
					Your name must be atleast 2 characters.
				</small>
			</div>
		</div>
		<div class="form-group">
			<label for="inputLastName">Last name</label>
			<input placeholder="Last name" type="text" name="lastName" id="lastName" ng-model="data.lastName" cols="30" rows="10" ng-minlength=2 required></input>
			<div class="error" ng-show="creditCardForm.lastName.$dirty && creditCardForm.lastName.$invalid">
				<small class="error"
				ng-show="creditCardForm.lastName.$error.required">
					Please enter your last name.
				</small>
				<small class="error" ng-show="creditCardForm.lastName.$error.minlength">
					Your last name must be at least 2 characters
				</small>
			</div>
		</div>
		<div class="form-group">
			<label for="inputCreditCardNumber">Credit card number</label>
			<input type="text" placeholder="Credit card number" name="creditCardNumber" id="creditCard" ng-model="data.creditCardNumber" ng-minlength=16 ng-maxlength=16 required></input>
			<div class="error" ng-show="creditCardForm.creditCard.$dirty && creditCardForm.creditCard.$invalid">
				<small class="error"
				ng-show="creditCardForm.creditCard.$error.required">
					Please enter credit card number.
				</small>
				<small class="error" ng-show="creditCardForm.creditCard.$error.minlength">
					The credit card number must be 16 characters.
				</small>
				<small class="error" ng-show="creditCardForm.creditCard.$error.maxlength">
					The credit card number must be 16 characters.
				</small>
			</div>
		</div>
		<div class="form-group">
			<label for="inputCreditCardSecurityNumber">Credit security number</label>
			<input type="text" placeholder="CVV2" name="creditCardSecurityNumber" id="creditCardSecurityNumber" ng-model="data.creditCardSecurityNumber" required></input>
			<div class="error" ng-show="creditCardForm.creditCardSecurityNumber.$dirty && creditCardForm.creditCardSecurityNumber.$invalid">
				<small class="error"
				ng-show="creditCardForm.creditCardSecurityNumber.$error.required">
					Please enter credit card security number.
				</small>
			</div>
		</div>
		<div class="form-group">
			<label for="selectCreditCardexpiryMonth">Credit card expiry month</label>
			<select class="form-control" for="expiryMonth" name="creditCardExpiryMonth" id="creditCardExpiryMonth">
			<option value="1">January</option>
			<option value="2">February</option>
			<option value="3">March</option>
			<option value="4">April</option>
			<option value="5">May</option>
			<option value="6">June</option>
			<option value="7">June</option>
			<option value="8">August</option>
			<option value="9">September</option>
			<option value="10">October</option>
			<option value="11">November</option>
			<option value="12">December</option>
		</select>
		</div>
		<div class="form-group">
			<label for="selectCreditCardExpiryYear">Credit card expiry year</label>
			<select class="form-control" for="ExpiryYear" name="creditCardExpiryYear" id="creditCardExpiryMonth">
			<option value="2014">2014</option>
			<option value="2015">2015</option>
			<option value="2016">2016</option>
			<option value="2017">2017</option>
			<option value="2018">2018</option>
			<option value="2019">2019</option>
			<option value="2020">2020</option>
		</select>
		</div>
		<div class="form-group">
			<label for="selectCreditCardExpiryYear">Credit card type</label>
			<select class="form-control" for="ExpiryYear" name="creditCardExpiryYear" id="creditCardExpiryMonth">
			<option value="visa">visa</option>
			<option value="mastercard">mastercard</option>
			<option value="discover">discover</option>
			<option value="amex">amex</option>
		</select>
		</div>
		<button class="btn btn-default" ng-disabled="creditCardForm.$invalid">Checkout</button>
	</fieldset>
</form>