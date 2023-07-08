<?php
foreach ($this->sections as $dot_path => $options) {
	$this->loadContent($dot_path);
}
