<?php if (!defined('FLUX_ROOT')) exit; ?>

<div class="kr-form-card">
	<div class="kr-form-card__header">
		<h2 class="kr-form-card__title"><?php echo htmlspecialchars(Flux::message('AccountCreateHeading')) ?></h2>
		<p class="kr-form-card__subtitle"><?php printf(htmlspecialchars(Flux::message('AccountCreateInfo')), '<a href="'.$this->url('service', 'tos').'">'.Flux::message('AccountCreateTerms').'</a>') ?></p>
	</div>

	<div class="kr-form-card__notices">
		<?php if (Flux::config('RequireEmailConfirm')): ?>
		<div class="kr-form-notice"><?php echo htmlspecialchars(Flux::message('AccountConfirmEmailInfo')) ?></div>
		<?php endif ?>
		<div class="kr-form-notice"><?php echo sprintf("Password must be between %d and %d characters.", Flux::config('MinPasswordLength'), Flux::config('MaxPasswordLength')) ?></div>
		<?php if (Flux::config('PasswordMinUpper') > 0): ?>
		<div class="kr-form-notice"><?php echo sprintf(Flux::message('PasswordNeedUpper'), Flux::config('PasswordMinUpper')) ?></div>
		<?php endif ?>
		<?php if (Flux::config('PasswordMinLower') > 0): ?>
		<div class="kr-form-notice"><?php echo sprintf(Flux::message('PasswordNeedLower'), Flux::config('PasswordMinLower')) ?></div>
		<?php endif ?>
		<?php if (Flux::config('PasswordMinNumber') > 0): ?>
		<div class="kr-form-notice"><?php echo sprintf(Flux::message('PasswordNeedNumber'), Flux::config('PasswordMinNumber')) ?></div>
		<?php endif ?>
		<?php if (Flux::config('PasswordMinSymbol') > 0): ?>
		<div class="kr-form-notice"><?php echo sprintf(Flux::message('PasswordNeedSymbol'), Flux::config('PasswordMinSymbol')) ?></div>
		<?php endif ?>
		<?php if (!Flux::config('AllowUserInPassword')): ?>
		<div class="kr-form-notice"><?php echo Flux::message('PasswordContainsUser') ?></div>
		<?php endif ?>
	</div>

	<?php if (isset($errorMessage)): ?>
	<div class="kr-form-card__error"><?php echo htmlspecialchars($errorMessage) ?></div>
	<?php endif ?>

	<form action="<?php echo $this->url ?>" method="post">
		<?php if (count($serverNames) === 1): ?>
		<input type="hidden" name="server" value="<?php echo htmlspecialchars($session->loginAthenaGroup->serverName) ?>" />
		<?php endif ?>

		<div class="kr-form-card__body">
			<?php if (count($serverNames) > 1): ?>
			<div class="kr-form-group">
				<label class="kr-form-label" for="register_server"><?php echo htmlspecialchars(Flux::message('AccountServerLabel')) ?></label>
				<select name="server" id="register_server" class="kr-form-input"<?php if (count($serverNames) === 1) echo ' disabled="disabled"' ?>>
					<?php foreach ($serverNames as $serverName): ?>
					<option value="<?php echo htmlspecialchars($serverName) ?>"<?php if ($params->get('server') == $serverName) echo ' selected="selected"' ?>><?php echo htmlspecialchars($serverName) ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<?php endif ?>

			<div class="kr-form-group">
				<label class="kr-form-label" for="register_username"><?php echo htmlspecialchars(Flux::message('AccountUsernameLabel')) ?></label>
				<input type="text" name="username" id="register_username" class="kr-form-input" value="<?php echo htmlspecialchars($params->get('username') ?: '') ?>" autocomplete="username" />
			</div>

			<div class="kr-form-row">
				<div class="kr-form-group">
					<label class="kr-form-label" for="register_password"><?php echo htmlspecialchars(Flux::message('AccountPasswordLabel')) ?></label>
					<input type="password" name="password" id="register_password" class="kr-form-input" autocomplete="new-password" />
				</div>
				<div class="kr-form-group">
					<label class="kr-form-label" for="register_confirm_password"><?php echo htmlspecialchars(Flux::message('AccountPassConfirmLabel')) ?></label>
					<input type="password" name="confirm_password" id="register_confirm_password" class="kr-form-input" autocomplete="new-password" />
				</div>
			</div>

			<div class="kr-form-row">
				<div class="kr-form-group">
					<label class="kr-form-label" for="register_email_address"><?php echo htmlspecialchars(Flux::message('AccountEmailLabel')) ?></label>
					<input type="text" name="email_address" id="register_email_address" class="kr-form-input" value="<?php echo htmlspecialchars($params->get('email_address') ?: '') ?>" />
				</div>
				<div class="kr-form-group">
					<label class="kr-form-label" for="register_email_address2"><?php echo htmlspecialchars(Flux::message('AccountEmailLabel2')) ?></label>
					<input type="text" name="email_address2" id="register_email_address2" class="kr-form-input" value="<?php echo htmlspecialchars($params->get('email_address2') ?: '') ?>" />
				</div>
			</div>

			<div class="kr-form-row">
				<div class="kr-form-group">
					<label class="kr-form-label"><?php echo htmlspecialchars(Flux::message('AccountGenderLabel')) ?></label>
					<div class="kr-form-radio-group">
						<label class="kr-form-radio">
							<input type="radio" name="gender" id="register_gender_m" value="M"<?php if ($params->get('gender') === 'M') echo ' checked="checked"' ?> />
							<span><?php echo $this->genderText('M') ?></span>
						</label>
						<label class="kr-form-radio">
							<input type="radio" name="gender" id="register_gender_f" value="F"<?php if ($params->get('gender') === 'F') echo ' checked="checked"' ?> />
							<span><?php echo $this->genderText('F') ?></span>
						</label>
					</div>
				</div>
				<div class="kr-form-group">
					<label class="kr-form-label"><?php echo htmlspecialchars(Flux::message('AccountBirthdateLabel')) ?></label>
					<div class="kr-form-date"><?php echo $this->dateField('birthdate',null,0) ?></div>
				</div>
			</div>

			<?php if (Flux::config('UseCaptcha')): ?>
			<div class="kr-form-group">
				<label class="kr-form-label"><?php echo htmlspecialchars(Flux::message('AccountSecurityLabel')) ?></label>
				<?php if (Flux::config('ReCaptchaPublicKey') === '...' || Flux::config('ReCaptchaPrivateKey') === '...'): ?>
					<div class="kr-form-card__error"><?php echo htmlspecialchars(Flux::message('AccountRecaptchaKey')) ?></div>
				<?php elseif (Flux::config('EnableReCaptcha')): ?>
					<div class="g-recaptcha" data-theme="dark" data-sitekey="<?php echo $recaptcha ?>"></div>
				<?php else: ?>
					<div class="kr-captcha">
						<div class="kr-captcha__image">
							<img src="<?php echo $this->url('captcha') ?>" />
						</div>
						<input type="text" name="security_code" id="register_security_code" class="kr-form-input" />
						<a href="javascript:refreshSecurityCode('.kr-captcha__image img')" class="kr-captcha__refresh"><?php echo htmlspecialchars(Flux::message('RefreshSecurityCode')) ?></a>
					</div>
				<?php endif ?>
			</div>
			<?php endif ?>
		</div>

		<div class="kr-form-card__footer">
			<p class="kr-form-card__terms"><?php printf(htmlspecialchars(Flux::message('AccountCreateInfo2')), '<a href="'.$this->url('service', 'tos').'">'.Flux::message('AccountCreateTerms').'</a>') ?></p>
			<button type="submit" class="kr-btn kr-btn--primary kr-btn--block"><?php echo htmlspecialchars(Flux::message('AccountCreateButton')) ?></button>
		</div>
	</form>
</div>
