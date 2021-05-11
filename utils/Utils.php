<?php
/*
 * Copyright (c) 2021 Jan Sohn.
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */

declare(strict_types=1);
namespace xxAROX\XSecurity\utils;
/**
 * Class Utils
 * @package xxAROX\XSecurity\utils
 * @author Jan Sohn / xxAROX - <jansohn@hurensohn.me>
 * @date 11. Mai, 2021 - 22:14
 * @ide PhpStorm
 * @project Core
 */
class Utils{
	/**
	 * Function checkForCaps
	 * @author Jibix YT
	 * @param string $text
	 * @return bool
	 */
	static function checkForCaps(string $text): bool{
		$num = preg_match_all("/[A-Z]/", $text);
		$percent = ($num / strlen($text)) * 100;
		return ($percent >= 60);
	}

	/**
	 * Function checkIfIsSame
	 * @author Jibix YT
	 * @param string $string1
	 * @param string $string2
	 * @return bool
	 */
	static function checkIfIsSame(string $string1, string $string2): bool{
		if (strtolower($string1) === strtolower($string2)) {
			return true;
		}
		$string3 = strlen($string1);
		$string4 = strlen($string2);

		$max = max($string3, $string4);
		$similarity = $i = $j = 0;

		while (($i < $string3) && isset($string2[$j])) {
			if ($string1[$i] == $string2[$j]) {
				$similarity++;
				$i++;
				$j++;
			} elseif ($string3 < $string4) {
				$string3++;
				$j++;
			} elseif ($string3 > $string4) {
				$i++;
				$string3--;
			} else {
				$i++;
				$j++;
			}
		}
		$percent = round($similarity / $max, 2) * 100;
		return ($percent >= 60);
	}
}
