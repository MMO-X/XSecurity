<?php
/*
 * Copyright (c) 2021 Jan Sohn.
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */

declare(strict_types=1);
namespace xxAROX\XSecurity\generic;
use JsonSerializable;


/**
 * Class Ban
 * @package xxAROX\XSecurity\generic
 * @author Jan Sohn / xxAROX - <jansohn@hurensohn.me>
 * @date 29. April, 2021 - 21:42
 * @ide PhpStorm
 * @project Core
 */
class Ban implements JsonSerializable{
	protected string $moderatorUuid;
	protected string $moderatorDisplayName;
	protected string $reason;
	protected int $until;
	protected bool $permanent;

	/**
	 * Function fromArray
	 * @param null|array $object
	 * @return null|Ban
	 */
	static function fromArray(?array $object): ?Ban{
		return (is_null($object) ? null : new Ban($object[0], $object[1], $object[2], $object[3], $object[4]));
	}

	/**
	 * Function toArray
	 * @return array
	 */
	public function jsonSerialize(): array{
		return [
			0 => $this->moderatorUuid,
			1 => $this->moderatorDisplayName,
			2 => $this->reason,
			3 => $this->until,
			4 => $this->permanent,
		];
	}

	/**
	 * Ban constructor.
	 * @param string $moderatorUuid
	 * @param string $moderatorDisplayName
	 * @param string $reason
	 * @param int $until
	 * @param bool $permanent
	 */
	public function __construct(string $moderatorUuid, string $moderatorDisplayName, string $reason, int $until, bool $permanent){
		$this->moderatorUuid = $moderatorUuid;
		$this->moderatorDisplayName = $moderatorDisplayName;
		$this->reason = $reason;
		$this->until = $until;
		$this->permanent = $permanent;
	}

	/**
	 * Function getModeratorUuid
	 * @return string
	 */
	public function getModeratorUuid(): string{
		return $this->moderatorUuid;
	}

	/**
	 * Function getModeratorDisplayName
	 * @return string
	 */
	public function getModeratorDisplayName(): string{
		return $this->moderatorDisplayName;
	}

	/**
	 * Function getReason
	 * @return string
	 */
	public function getReason(): string{
		return $this->reason;
	}

	/**
	 * Function getUntil
	 * @return int
	 */
	public function getUntil(): int{
		return $this->until;
	}

	/**
	 * Function getPermanent
	 * @return bool
	 */
	public function isPermanent(): bool{
		return $this->permanent;
	}
}
