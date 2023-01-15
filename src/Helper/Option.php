<?php

namespace Dot\Helper;

!defined('WPINC ') or die();

/**
 * Helper library for framework
 */

trait Option
{
	/** Features Hooks Lists */
	public function FeatureHooksLists($features, $hooks, $options = [])
	{
		$featureHooks = [];
		foreach ($features as $slug => $feature) {
			if (!isset($hooks[$slug])) {
				continue;
			} // Unlists feature with no hooks.
			$featureHooks[$slug] = $feature->getVars();
			$featureHooks[$slug]['hooksCount'] = count($hooks[$slug]);
			$featureHooks[$slug]['hooks'] = $hooks[$slug];
			$featureHooks[$slug]['activeHooks'] = 0;
			foreach ($featureHooks[$slug]['hooks'] as $key => &$hook) {
				$tmp = [];
				/** Reconstruct Class */
				$tmp['namespace'] = (new \ReflectionClass(
					$hook->getComponent()
				))->getNamespaceName();
				$tmp['name'] = (new \ReflectionClass(
					$hook->getComponent()
				))->getShortName();
				$tmp['namespaceKey'] = str_replace(
					'\\',
					'_',
					strtolower($tmp['namespace'])
				);
				$tmp['hookName'] = preg_replace(
					'/[^A-Za-z0-9_]/',
					'',
					strtolower($hook->getHook())
				);
				$tmp['callbackName'] = preg_replace(
					'/[^A-Za-z0-9_]/',
					'',
					strtolower($hook->getCallback())
				);
				$key = sprintf(
					'hooks_%s_%s_%s_%s',
					$tmp['namespaceKey'],
					strtolower($tmp['name']),
					$tmp['hookName'],
					$tmp['callbackName']
				);
				$tmp['key'] = $key;
				$tmp['status'] = isset($options->dot_hooks->$key)
					? $options->dot_hooks->$key
					: $hook->isStatus(); // Option Exists
				$tmp['status'] =
					$tmp['status'] === 'true' || $tmp['status'] == '1' ? true : false; // Grab option status
				if ($tmp['status'] == true || $hook->isMandatory()) {
					$featureHooks[$slug]['activeHooks']++;
				}
				$tmp['mandatory'] = $hook->isMandatory();
				/** Hook Info */
				$tmp['hookName'] = $hook->getHook();
				$tmp['callbackName'] = $hook->getCallback();
				$tmp['description'] = $hook->getDescription();
				$hook = $tmp;
			}
		}

		return $featureHooks;
	}

	/** Array Merge Recursive */
	public function ArrayMergeRecursive(array $array1, array $array2)
	{
		$merged = $array1;
		foreach ($array2 as $key => &$value) {
			if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
				$merged[$key] = $this->ArrayMergeRecursive($merged[$key], $value);
			} elseif (is_numeric($key)) {
				if (!in_array($value, $merged)) {
					$merged[] = $value;
				}
			} else {
				$merged[$key] = $value;
			}
		}
		return $merged;
	}

	/** Transform Boolean Value */
	public function transformBooleanValue($data)
	{
		if (is_array($data)) {
			foreach ($data as $key => &$value) {
				if (is_array($value)) {
					$value = $this->transformBooleanValue($value);
				} else {
					$value = $value === 'true' || $value === '1' ? 1 : 0;
				}
			}
		} else {
			$data = $data === 'true' || $data === '1' ? 1 : 0;
		}
		return $data;
	}
}
