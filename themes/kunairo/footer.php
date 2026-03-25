<?php if (!defined('FLUX_ROOT')) exit; ?>
			</main>
		</div>
		<!-- end .kr-layout -->

		<!-- ===== FOOTER ===== -->
		<footer class="kr-footer">
			<div class="kr-footer__glow"></div>
			<div class="kr-footer__inner">
				<div class="kr-footer__brand">
					<span class="kr-footer__logo">Kunai<span class="kr-footer__logo-accent">RO</span></span>
					<span class="kr-footer__tagline"><?php echo htmlspecialchars(Flux::message('KunaiROFooterTagline')) ?></span>
				</div>

				<div class="kr-footer__links">
					<a href="<?php echo $this->url('main') ?>"><?php echo htmlspecialchars(Flux::message('MenuMainLabel')) ?></a>
					<a href="<?php echo $this->url('account', 'create') ?>"><?php echo htmlspecialchars(Flux::message('CreateAccountLabel')) ?></a>
					<a href="<?php echo $this->url('ranking') ?>"><?php echo htmlspecialchars(Flux::message('MenuRankingsLabel')) ?></a>
					<a href="<?php echo $this->url('server', 'status') ?>"><?php echo htmlspecialchars(Flux::message('MenuServerStatusLabel')) ?></a>
				</div>

				<div class="kr-footer__selectors">
					<?php if (count(Flux::$appConfig->get('ThemeName', false)) > 1): ?>
					<div class="kr-footer__selector">
						<label>Theme:</label>
						<select name="preferred_theme" onchange="updatePreferredTheme(this)" class="kr-select kr-select--sm">
							<?php foreach (Flux::$appConfig->get('ThemeName', false) as $themeName): ?>
							<option value="<?php echo htmlspecialchars($themeName) ?>"<?php if ($session->theme == $themeName) echo ' selected="selected"' ?>><?php echo htmlspecialchars($themeName) ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<?php endif ?>

					<div class="kr-footer__selector">
						<label>Language:</label>
						<select name="preferred_language" onchange="updatePreferredLanguage(this)" class="kr-select kr-select--sm">
							<?php foreach (Flux::getAvailableLanguages() as $lang_key => $lang): ?>
							<option value="<?php echo htmlspecialchars($lang_key) ?>"<?php if (!empty($_COOKIE['language']) && $_COOKIE['language'] == $lang_key) echo ' selected="selected"' ?>><?php echo htmlspecialchars($lang) ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<?php if (Flux::config('ShowCopyright')): ?>
				<div class="kr-footer__copyright">
					Powered by <a href="https://github.com/rathena/FluxCP" target="_blank" rel="noopener">FluxCP</a>
					&mdash; <?php echo htmlspecialchars(Flux::message('KunaiROFooterCopyright')) ?>
				</div>
				<?php endif ?>

				<?php if (Flux::config('ShowRenderDetails')): ?>
				<div class="kr-footer__meta">
					Page rendered in <strong><?php echo round(microtime(true) - __START__, 5) ?></strong>s
					&middot; Queries: <strong><?php echo (int)Flux::$numberOfQueries ?></strong>
					<?php if (Flux::config('GzipCompressOutput')): ?>&middot; Gzip: <strong>On</strong><?php endif ?>
				</div>
				<?php endif ?>
			</div>

			<form action="<?php echo $this->urlWithQs ?>" method="post" name="preferred_theme_form" style="display: none">
				<input type="hidden" name="preferred_theme" value="" />
			</form>
		</footer>
	</body>
</html>
