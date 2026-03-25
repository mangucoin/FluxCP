<?php if (!defined('FLUX_ROOT')) exit; ?>

<div class="kr-form-card">
	<div class="kr-form-card__header">
		<h2 class="kr-form-card__title"><?php echo htmlspecialchars(Flux::message('LoginHeading')) ?></h2>
		<?php if (isset($errorMessage)): ?>
			<div class="kr-form-card__error"><?php echo htmlspecialchars($errorMessage) ?></div>
		<?php elseif ($auth->actionAllowed('account', 'create')): ?>
			<p class="kr-form-card__subtitle"><?php printf(Flux::message('LoginPageMakeAccount'), $this->url('account', 'create')); ?></p>
		<?php endif ?>
	</div>

	<form action="<?php echo $this->url('account', 'login', array('return_url' => $params->get('return_url'))) ?>" method="post">
		<?php if (count($serverNames) === 1): ?>
		<input type="hidden" name="server" value="<?php echo htmlspecialchars($session->loginAthenaGroup->serverName) ?>" />
		<?php endif ?>

		<div class="kr-form-card__body">
			<div class="kr-form-group">
				<label class="kr-form-label" for="login_username"><?php echo htmlspecialchars(Flux::message('AccountUsernameLabel')) ?></label>
				<input type="text" name="username" id="login_username" class="kr-form-input" value="<?php echo htmlspecialchars($params->get('username') ?: '') ?>" autocomplete="username" />
			</div>

			<div class="kr-form-group">
				<label class="kr-form-label" for="login_password"><?php echo htmlspecialchars(Flux::message('AccountPasswordLabel')) ?></label>
				<input type="password" name="password" id="login_password" class="kr-form-input" autocomplete="current-password" />
			</div>

			<?php if (count($serverNames) > 1): ?>
			<div class="kr-form-group">
				<label class="kr-form-label" for="login_server"><?php echo htmlspecialchars(Flux::message('AccountServerLabel')) ?></label>
				<select name="server" id="login_server" class="kr-form-input"<?php if (count($serverNames) === 1) echo ' disabled="disabled"' ?>>
					<?php foreach ($serverNames as $serverName): ?>
					<option value="<?php echo htmlspecialchars($serverName) ?>"><?php echo htmlspecialchars($serverName) ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<?php endif ?>

			<?php if (Flux::config('UseLoginCaptcha')): ?>
			<div class="kr-form-group">
				<label class="kr-form-label"><?php echo htmlspecialchars(Flux::message('AccountSecurityLabel')) ?></label>
				<?php if (Flux::config('EnableReCaptcha')): ?>
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
			<button type="submit" class="kr-btn kr-btn--primary kr-btn--block"><?php echo htmlspecialchars(Flux::message('LoginButton')) ?></button>
		</div>
	</form>
</div>
