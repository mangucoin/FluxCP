<?php if (!defined('FLUX_ROOT')) exit; ?>

<!-- ===== HERO SECTION ===== -->
<section class="kr-hero">
	<!-- Multi-layer animated background -->
	<div class="kr-hero__bg">
		<div class="kr-hero__bg-deep"></div>
		<div class="kr-hero__bg-fire"></div>
		<div class="kr-hero__bg-energy"></div>
		<div class="kr-hero__bg-smoke"></div>
		<div class="kr-hero__bg-sparks"></div>
		<div class="kr-hero__bg-radial"></div>
		<div class="kr-hero__bg-scanlines"></div>
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
			<span class="kr-hero__divider-wing kr-hero__divider-wing--left"></span>
			<span class="kr-hero__divider-diamond"></span>
			<span class="kr-hero__divider-wing kr-hero__divider-wing--right"></span>
		</div>

		<!-- Description -->
		<p class="kr-hero__description"><?php echo htmlspecialchars(Flux::message('KunaiROHeroDescription')) ?></p>

		<!-- CTA Buttons -->
		<div class="kr-hero__actions">
			<a href="<?php echo $this->url('account', 'create') ?>" class="kr-btn kr-btn--primary kr-btn--xl kr-btn--glow">
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

	<!-- Bottom fade into next section -->
	<div class="kr-hero__fade"></div>
</section>

<!-- ===== NEWS SECTION ===== -->
<section class="kr-section kr-section--news">
	<div class="kr-container">
<?php if(Flux::config('CMSNewsOnHomepage')): ?>
		<h2 class="kr-section__heading">
			<span class="kr-section__heading-icon">&#9876;</span>
			<?php echo htmlspecialchars(sprintf(Flux::message('MainPageWelcome'), Flux::config('SiteTitle'))) ?>
		</h2>

	<?php if($newstype == '1'):?>
		<?php if($news): ?>
			<div class="kr-news-grid">
			<?php $newsIndex = 0; foreach($news as $nrow): $newsIndex++; ?>
				<article class="kr-card kr-card--news<?php if ($newsIndex === 1) echo ' kr-card--featured' ?>">
					<div class="kr-card__accent"></div>
					<div class="kr-card__inner">
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
						<a href="<?php echo $nrow->link ?>" class="kr-card__link"><?php echo htmlspecialchars(Flux::message('CMSNewsLink')) ?> &rarr;</a>
						<?php endif; ?>
					</div>
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
				<article class="kr-card kr-card--news<?php if ($i === 1) echo ' kr-card--featured' ?>">
					<div class="kr-card__accent"></div>
					<div class="kr-card__inner">
						<div class="kr-card__header">
							<h3 class="kr-card__title"><?php echo $rssItem->title ?></h3>
							<span class="kr-card__meta"><?php echo date(Flux::config('DateFormat'),strtotime($rssItem->pubDate))?></span>
						</div>
						<div class="kr-card__body">
							<?php echo $rssItem->description ?>
						</div>
						<a href="<?php echo $rssItem->link ?>" class="kr-card__link"><?php echo htmlspecialchars(Flux::message('CMSNewsLink')) ?> &rarr;</a>
					</div>
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
		<li><p><?php echo htmlspecialchars(sprintf(Flux::message('MainPageStep1'), __FILE__)) ?></p></li>
		<li><p><?php echo htmlspecialchars(Flux::message('MainPageStep2')) ?></p></li>
	</ol>
<?php endif ?>
	</div>
</section>
