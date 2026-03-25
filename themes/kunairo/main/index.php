<?php if (!defined('FLUX_ROOT')) exit; ?>

<!-- ===== HERO SECTION ===== -->
<section class="kr-hero">
	<!-- Animated background layers -->
	<div class="kr-hero__bg">
		<div class="kr-hero__bg-base"></div>
		<div class="kr-hero__bg-energy"></div>
		<div class="kr-hero__bg-smoke"></div>
		<div class="kr-hero__bg-embers"></div>
		<div class="kr-hero__bg-vignette"></div>
	</div>

	<div class="kr-hero__content">
		<!-- Badges -->
		<div class="kr-hero__badges">
			<span class="kr-badge kr-badge--fire"><?php echo htmlspecialchars(Flux::message('KunaiROBadgePreRenewal')) ?></span>
			<span class="kr-badge kr-badge--gold"><?php echo htmlspecialchars(Flux::message('KunaiROBadgeRates')) ?></span>
			<span class="kr-badge kr-badge--steel"><?php echo htmlspecialchars(Flux::message('KunaiROBadgeNoPTW')) ?></span>
		</div>

		<!-- Title -->
		<h1 class="kr-hero__title">
			<span class="kr-hero__title-kunai">Kunai</span><span class="kr-hero__title-ro">RO</span>
		</h1>

		<!-- Tagline -->
		<p class="kr-hero__tagline"><?php echo htmlspecialchars(Flux::message('KunaiROHeroTagline')) ?></p>

		<!-- Decorative divider -->
		<div class="kr-hero__divider">
			<span class="kr-hero__divider-line"></span>
			<span class="kr-hero__divider-diamond"></span>
			<span class="kr-hero__divider-line"></span>
		</div>

		<!-- Description -->
		<p class="kr-hero__description"><?php echo htmlspecialchars(Flux::message('KunaiROHeroDescription')) ?></p>

		<!-- CTA Buttons -->
		<div class="kr-hero__actions">
			<a href="<?php echo $this->url('account', 'create') ?>" class="kr-btn kr-btn--primary kr-btn--lg kr-btn--glow">
				<?php echo htmlspecialchars(Flux::message('KunaiROBtnPlay')) ?>
			</a>
			<a href="<?php echo $this->url('account', 'create') ?>" class="kr-btn kr-btn--secondary kr-btn--lg">
				<?php echo htmlspecialchars(Flux::message('KunaiROBtnRegister')) ?>
			</a>
			<a href="#" class="kr-btn kr-btn--ghost kr-btn--lg">
				<?php echo htmlspecialchars(Flux::message('KunaiROBtnDiscord')) ?>
			</a>
		</div>
	</div>
</section>

<!-- ===== NEWS / CONTENT SECTION ===== -->
<section class="kr-section">
<?php if(Flux::config('CMSNewsOnHomepage')): ?>
	<h2 class="kr-section__heading">
		<?php echo htmlspecialchars(sprintf(Flux::message('MainPageWelcome'), Flux::config('SiteTitle'))) ?>
	</h2>

	<?php if($newstype == '1'):?>
		<?php if($news): ?>
			<div class="kr-news-grid">
			<?php foreach($news as $nrow):?>
				<article class="kr-card kr-card--news">
					<div class="kr-card__header">
						<h3 class="kr-card__title"><?php echo $nrow->title ?></h3>
						<span class="kr-card__meta">
							<?php echo $nrow->author ?> &middot; <?php echo date(Flux::config('DateFormat'),strtotime($nrow->created))?>
						</span>
					</div>
					<div class="kr-card__body">
						<?php echo $nrow->body ?>
					</div>
					<?php if($nrow->created != $nrow->modified && Flux::config('CMSDisplayModifiedBy')):?>
					<div class="kr-card__footer">
						<small><?php echo htmlspecialchars(Flux::message('CMSModifiedLabel')) ?>: <?php echo date(Flux::config('DateFormat'),strtotime($nrow->modified))?></small>
					</div>
					<?php endif; ?>
					<?php if($nrow->link): ?>
					<a href="<?php echo $nrow->link ?>" class="kr-card__link"><?php echo htmlspecialchars(Flux::message('CMSNewsLink')) ?></a>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
			</div>
		<?php else: ?>
			<p class="kr-text-muted"><?php echo htmlspecialchars(Flux::message('CMSNewsEmpty')) ?></p>
		<?php endif ?>

	<?php elseif($newstype == '2'):?>
		<?php if(isset($xml) && isset($xml->channel)): ?>
		<div class="kr-news-grid">
			<?php $i = 0; foreach($xml->channel->item as $rssItem): ?>
				<?php $i++; if($i <= $newslimit): ?>
				<article class="kr-card kr-card--news">
					<div class="kr-card__header">
						<h3 class="kr-card__title"><?php echo $rssItem->title ?></h3>
						<span class="kr-card__meta"><?php echo date(Flux::config('DateFormat'),strtotime($rssItem->pubDate))?></span>
					</div>
					<div class="kr-card__body">
						<?php echo $rssItem->description ?>
					</div>
					<a href="<?php echo $rssItem->link ?>" class="kr-card__link"><?php echo htmlspecialchars(Flux::message('CMSNewsLink')) ?></a>
				</article>
				<?php endif ?>
			<?php endforeach; ?>
		</div>
		<?php else: ?>
			<p class="kr-text-muted"><?php echo htmlspecialchars(Flux::message('CMSNewsRSSNotFound')) ?></p>
		<?php endif ?>
	<?php endif ?>

<?php else: ?>
	<h2 class="kr-section__heading"><?php echo htmlspecialchars(Flux::message('MainPageHeading')) ?></h2>
	<p><strong><?php echo htmlspecialchars(Flux::message('MainPageInfo')) ?></strong></p>
	<p><?php echo htmlspecialchars(Flux::message('MainPageInfo2')) ?></p>
	<ol>
		<li><p class="green"><?php echo htmlspecialchars(sprintf(Flux::message('MainPageStep1'), __FILE__)) ?></p></li>
		<li><p class="green"><?php echo htmlspecialchars(Flux::message('MainPageStep2')) ?></p></li>
	</ol>
	<p style="text-align: right"><strong><em><?php echo htmlspecialchars(Flux::message('MainPageThanks')) ?></em></strong></p>
<?php endif ?>
</section>
