<div class="dot-container">

	<div class="header bg-white shadow-sm rounded-lg mt-6 mr-4">
		<nav class="flex flex-wrap items-center px-4 py-2" role="navigation">

			<div class="text-white flex-shrink flex items-center relative rounded-lg bg-white py-2 px-4 mr-4 md:mr-8">
				<div class="w-4 h-4 bg-primary-600 rounded-full"></div>
				<h1 class="text-gray-800 text-lg font-medium ml-4">
					<?php echo esc_attr($this->Page->getPageTitle()); ?>
				</h1>
			</div>

			<div class="md:w-auto md:flex-grow md:flex md:items-center absolute display-inline-block float-right right-0">
				<ul class="dot-menu-desktop nav-tab-wrapper <?php echo isset($disableTab)
    	? ''
    	: 'nav-tab-general'; ?> <?php echo isset($active) ? 'tab-active' : ''; ?>
				hidden sm:inline-flex flex-row cursor-pointer mx-4 mt-3 p-2">
					<?php foreach ($this->sections as $path => $section): ?>
						<?php
      extract($this->sectionLoopLogic($path, $section));
      $type = !strpos($tab, 'href') ? 'nav-nonurl' : '';
      ?>
						<li
							class="px-8 py-2 first:border-0 border-l-2 border-gray-100
							<?php echo esc_attr($type); ?> <?php echo $active ? 'tab-active' : ''; ?>"
							data-tab="section-<?php echo esc_attr($slug); ?>"
						>
							<div class="block">
								<?php /** Tab contains 2 types: External Link (https://google.com) and Internal Link (#setting) */
        echo strpos($tab, '//') ? esc_url($tab) : esc_attr($tab); ?>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>

				<div class="sm:hidden inline-block float-right right-0">
					<div class="dot-menu-responsive mx-4 pr-3">
						<span class="rounded-md shadow-sm">
							<button
							class="inline-flex justify-center w-full px-2 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white rounded-md hover:text-gray-500 active:bg-gray-50 active:text-gray-800"
							type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
								</svg>
							</button>
						</span>
						<div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95 absolute z-50 right-0 mx-4">
							<div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none z-50" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
								<?php foreach ($this->sections as $path => $section): ?>
                                    <?php
                                    extract(
                                    	$this->sectionLoopLogic($path, $section)
                                    );
                                    $type = !strpos($tab, 'href')
                                    	? 'nav-nonurl'
                                    	: '';
                                    ?>
										<div class="py-1">
											<div data-tab="section-<?php echo esc_attr(
           	$slug
           ); ?>" class="menu-item cursor-pointer text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left"  role="menuitem" >
                                                <?php /** Tab contains 2 types: External Link (https://google.com) and Internal Link (#setting) */
                                                echo strpos($tab, '//')
                                                	? esc_url($tab)
                                                	: esc_attr($tab); ?>
											</div>
										</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>

			</div>
		</nav>
	</div>
	<?php if (!$this->Helper->isPremiumPlan() && $this->Helper->getUpgradeURL()): ?>
		<div class="header bg-primary-500 text-white shadow-sm rounded-lg border border-gray-200 mt-6 mr-4">
			<a href="<?php echo esc_url($this->Helper->getUpgradeURL()); ?>">
				<div class="flex-shrink flex items-center relative rounded-lg py-4 px-6">
					<em class="fas fa-exclamation"></em>
					<p class="ml-4">
						You are using free plan. Upgrade Now for better Experience!
					</p>
				</div>
			</a>
		</div>
	<?php endif; ?>
	<div class="content py-4 mr-4">
		<?php foreach ($this->sections as $path => $section): ?>
			<?php extract($this->sectionLoopLogic($path, $section)); ?>
			<div id="section-<?php echo esc_attr(
   	$slug
   ); ?>" class="tab-content dot-sections <?php echo $active
	? 'current'
	: ''; ?>">
				<?php if (isset($section['link']) && strpos($section['link'], '//')) {
    	echo esc_url($section['link']);
    } else {
    	$this->loadContent($content);
    } ?>
			</div>
			<?php if ($active): ?>
				<div stlye="display:none;">
					<input type="hidden" name="activeSection" value="<?php echo esc_attr(
     	$slug
     ); ?>">
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>

</div>
