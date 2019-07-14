<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $page_title ?></title>
		<style>
			body, html {
				font-family: monospace;
			}
			.container {
				max-width: 800px;
				width: 100%;
				height: 100%;
				margin: 0 auto;
			}
			.input {
				border: 1px solid black;
			    font-family: monospace;
			    border-radius: 3px;
			    padding: 3px;
			    margin-top: 3px;
			    background-color: rgba(0, 0, 0, 0);
			}
		</style>
	</head>
	<body>
		<div class="container">
		<?php if($page == "invalid_key") { ?>
			<p>No Masterkey Provided, Or Invalid Masterkey Provided.</p>
		<?php } ?>
		<?php if($page == "updated_rates") { ?>
			<p>Rates have been updated.</p>
		<?php } ?>
		<?php if($page == "home") { ?>
			<p>Welcome to the Website, This is an actual Payment Gateway Service (Technically, For the Most Part)</p>
			<a href="<?php echo $url ?>user">Go To Users Area</a> <a href="<?php echo $url ?>user/register">Go To Register</a>
		<?php } ?>
		<?php if($page == "logged_in") { ?>
			<p>Currently Logged in As: <?php echo $user["username"] ?><br><br>
			<a href="<?php echo $url ?>user/change_address">Change Name</a> <a href="<?php echo $url ?>user/change_password">Change Password</a> <a href="<?php echo $url ?>user/logout">Logout</a><br><br>
Your Balance is: <span style="text-decoration: underline;"><?php echo $user["balance_held_in_currency"] ?></span> <span style="text-transform: uppercase"><?php echo $user["currency"] ?></span><br><br>
You can receive money through the following ways:-<br>
	-> Someone sends you Money to your E-Mail Address: <?php echo $user["email"] ?><br>
	-> You can receive money anonymously by your Unique Address: <?php echo $user["unique_address"] ?><br><br>
<a href="<?php echo $url ?>user/send">Send Money</a><br><br>
Address Info:-<br><br>
Address Line 1: <?php echo $user["address"]["line_1"] ?><br>
Address Line 2: <?php echo $user["address"]["line_2"] ?><br>
City: <?php echo $user["address"]["city"] ?><br>
Zip Code: <?php echo $user["address"]["zipcode"] ?><br>
State: <?php echo $user["address"]["state"] ?><br>
Country: <?php echo $user["address"]["country"] ?><br><br>
<a href="<?php echo $url ?>user/change_address">Change Address</a><br><br>
Recent (5) Transactions:-<br><br>
<?php if(isset($user["recent_transactions"])) { foreach($user["recent_transactions"] as $key => $transaction) { ?>
(<?php echo $transaction["id"] ?>)-> Sent <span style="text-decoration:underline;"><?php echo $transaction["amount_in_currency"] ?></span> <span style="text-transform: uppercase;"><?php echo $user["currency"] ?></span> To <strong><?php echo $transaction["sent_to"] ?></strong> on <?php echo $transaction["date"] ?><br>
<?php } ?><br><a href="<?php echo $url ?>user/transactions">View All Transactions</a> <?php } else { ?>
No Transactions to Show.
<?php } ?><br><br>
API Access :-<br><br>
<?php if(isset($user["merchant_info"])) { ?>
<?php if(isset($user['access_key'])) { ?>API Access Key: <?php echo $user["access_key"] ?><?php } ?> <a href="<?php echo $url ?>user/new_key">Generate a New Key</a><br><br>
<a href="<?php echo $url ?>api">API Reference</a><br><br>
Merchant Name: <?php echo $user["merchant_info"]["name"] ?><br>
Merchant Description: <?php echo $user["merchant_info"]["description"] ?><br><br>
<a href="<?php echo $url ?>user/change_merchant_info">Change Merchant Info</a>
<?php } else { ?>
You need to have a Merchant Account for API Access<br><br>
<a href="<?php echo $url ?>user/upgrade">Upgrade to Merchant Account (Cannot be Undone)</a><br><br>
<?php } ?>
			</p>
			</a>
		<?php } ?>
		<?php if($page == "login") { ?>
				Fill in the Boxes below.<br>
				<?php if(isset($error_msg)) { echo $error_msg; } ?>
				<form method="post" action="<?php echo $url ?>user">
					<input class="input" type="email" name="email" id="email" placeholder="Enter your E-Mail" />
					<br>
					<input class="input" type="password" name="password" id="password" placeholder="Enter your Password" />
					<input class="input" type="hidden" name="login-submission" value="true" />
					<br>
					<input class="input" type="submit" value="Login" />
				</form>
						
		<?php } ?>
		<?php if($page == "merchant_upgrade") { ?>
			<?php if(!isset($user["merchant_info"])) { ?>
				Enter your Information Below, and the Upgrade will be complete. This Action cannot be undone!<br>
				<?php if(isset($merchant_upgrade)) { echo $merchant_upgrade["error"]; } ?>
				<form method="post" action="<?php echo $url ?>user/upgrade">
					<input class="input" type="text" name="merchant_name" id="merchant_name" placeholder="Merchant Name" />
					<br>
					<textarea class="input" name="merchant_description" placeholder="Enter your Merchant Description"></textarea>
					<input class="input" type="hidden" name="upgrade-submission" value="true" />
					<br>
					<input class="input" type="submit" value="Become a Merchant!" />
				</form>
			<?php } else { ?>
				<?php if(isset($merchant_upgrade)) { ?>Your account has been Ugraded to Merchant Status!<?php } else { ?>Your Account has Merchant Status.<?php } ?><br><br>
				Your Merchant Name: <?php echo $user["merchant_info"]["name"] ?><br>
				Your Merchant Description: <?php echo $user["merchant_info"]["description"] ?><br>
			<?php } ?><br>
			<a href="<?php echo $url ?>user">Back to Account Home</a>
		<?php } ?>
		<?php if($page == "change_address") { ?>
				Enter your Information Below, and the Address will be Changed.<br>
				<?php if(isset($address_change)) { echo $address_change["error"]; } ?>
				<form method="post" action="<?php echo $url ?>user/change_address">
					<input class="input" type="text" name="name" id="name" placeholder="Full Name" value="<?php echo $user['username'] ?>"/>
					<br>
					<input class="input" type="text" name="line_1" id="line_1" placeholder="Address Line 1" value="<?php echo $user['address']['line_1'] ?>"/>
					<br>
					<input class="input" type="text" name="line_2" id="line_2" placeholder="Address Line 2" value="<?php echo $user['address']['line_2'] ?>" />
					<br>
					<input class="input" type="text" name="city" id="city" placeholder="City" value="<?php echo $user['address']['city'] ?>" />
					<br>
					<input class="input" type="text" name="zipcode" id="zipcode" placeholder="Zip Code" value="<?php echo $user['address']['zipcode'] ?>" />
					<br>
					<input class="input" type="text" name="state" id="state" placeholder="State" value="<?php echo $user['address']['state'] ?>" />
					<br>
					<input class="input" type="text" name="country" id="country" placeholder="Country" value="<?php echo $user['address']['country'] ?>" />
					<br>
					<input class="input" type="hidden" name="address-change-submission" value="true" />
					<input class="input" type="submit" value="Change Address" />
				</form>
			<br><a href="<?php echo $url ?>user">Back to Account Home</a>
		<?php } ?>
		<?php if($page == "change_merchant_info") { ?>
				Enter your Information Below, and the Merchant Info will be Changed.<br>
				<?php if(isset($merchant_info_change)) { echo $merchant_info_change["error"]; } ?>
				<form method="post" action="<?php echo $url ?>user/change_merchant_info">
					<input class="input" type="text" name="merchant_name" id="merchant_name" placeholder="Merchant Name" value="<?php echo $user['merchant_info']['name'] ?>" />
					<br>
					<textarea class="input" name="merchant_description" id="merchant_description" placeholder="Merchant Description"><?php echo $user['merchant_info']['description'] ?></textarea>
					<br>
					<input class="input" type="hidden" name="merchant-info-change-submission" value="true" />
					<input class="input" type="submit" value="Change Merchant Info" />
				</form>
			<br><a href="<?php echo $url ?>user">Back to Account Home</a>
		<?php } ?>
		<?php if($page == "change_password") { ?>
				Enter your Information Below, and the Merchant Info will be Changed.<br>
				<?php if(isset($password_change)) { echo $password_change["error"]; } ?>
				<form method="post" action="<?php echo $url ?>user/change_password">
					<input class="input" type="password" name="new_password" id="new_password" placeholder="New Password" />
					<br>
					<input class="input" type="password" name="password_confirmation" id="password_confirmation" placeholder="Password Confirmation" />
					<br>
					<input class="input" type="password" name="curr_password" id="curr_password" placeholder="Current Password" />
					<br>
					<input class="input" type="hidden" name="password-change-submission" value="true" />
					<input class="input" type="submit" value="Change Password" />
				</form>
			<br><a href="<?php echo $url ?>user">Back to Account Home</a>
		<?php } ?>
		<?php if($page == "transactions") { ?>
			<a href="<?php echo $url ?>user">Back to Account Home</a><br><br>
			All of your Transactions are down below:-<br><br>
			<?php if(count($transactions) > 0) {
				foreach($transactions as $key => $transaction) { ?>
					(<?php echo $transaction["id"] ?>)-> Sent <span style="text-decoration: underline"><?php echo $transaction["amount_in_currency"] ?></span> <span style="text-transform: uppercase"><?php echo $user["currency"] ?></span> To <strong><?php echo $transaction["sent_to"] ?></strong> on <?php echo $transaction["date"] ?>
			<?php }
			} else { ?>
				No Transactions have been made yet.
		<?php } } ?>
	</div>
	</body>
</html>