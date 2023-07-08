<?php
/**
 * Backend Page Setting - About Page
 */
$config = $this->Framework->getConfig(); ?>

<div class="-mx-2 my-2 px-2">

    <main class="grid grid-cols-1 md:grid-cols-5 my-2 w-full bg-white shadow-md rounded-lg overflow-hidden">

        <div class="col-span-4 mx-8 md:mx-16 my-12">
            <h2 class="text-3xl md:text-5xl font-medium mb-4">
                <?php echo esc_html($this->Framework->getName()); ?>
            </h2>

            <div class="flex items-center">
                <div class="text-sm inline-flex items-center leading-sm px-3 py-1 mb-4 bg-primary-600 text-white rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    <?php $url = isset($config->url->wordpress)
                    	? $config->url->wordpress
                    	: '#'; ?>
                    <a href="<?php echo esc_url($url); ?>" <?php if (
	$url != '#'
) {
	echo 'target="_blank"';
} ?>>
                        <?php echo esc_attr($this->Framework->getVersion()); ?>
                    </a>
                </div>
                <?php $url = isset($config->url->contact)
                	? $config->url->contact
                	: '#'; ?>
                <a href="<?php echo esc_url(
                	$url
                ); ?>" target="_blank" class="text-sm inline-flex items-center leading-sm px-3 py-1 mb-4 ml-2 bg-primary-600 text-white rounded-full">
                    <i class="fas fa-paper-plane mr-2"></i>
					<?php echo esc_html__('Contact', 'dot'); ?>
                </a>
            </div>

            <p class="text-lg">
                <?php echo esc_attr($this->Framework->getConfig()->description)
                	? esc_attr($this->Framework->getConfig()->description)
                	: ''; ?>
            </p>
        </div>

    </main>

</div>
