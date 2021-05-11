<?php
/*
 * Copyright (c) 2021 Jan Sohn.
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */

declare(strict_types=1);
namespace xxAROX\XSecurity\player;
use xxAROX\Core\player\classes\FunctionalPlayer;
use xxAROX\XSecurity\generic\Ban;
use xxAROX\XSecurity\generic\Mute;


/**
 * Class SecurityPlayer
 * @package xxAROX\XSecurity\player
 * @author Jan Sohn / xxAROX - <jansohn@hurensohn.me>
 * @date 29. April, 2021 - 21:29
 * @ide PhpStorm
 * @project Core
 */
class SecurityPlayer extends FunctionalPlayer{
	protected int $muteCount = 0;
	protected ?Mute $mute = null;

	protected int $banCount = 0;
	protected ?Ban $ban = null;

	/**
	 * Function loadData
	 * @param array $data
	 * @return void
	 */
	public function loadData(array $data): void{
		if (isset($data["mute"])) {
			$this->muteCount = $data["mute"]["count"] ?? 0;
			$this->mute = Mute::fromArray($data["mute"]["object"] ?? null);
		}
		if (isset($data["ban"])) {
			$this->muteCount = $data["ban"]["count"] ?? 0;
			$this->ban = Ban::fromArray($data["ban"]["object"] ?? null);
		}
	}

	/**
	 * Function saveData
	 * @param array $data
	 * @return array
	 */
	public function saveData(array $data): array{
		$data["mute"] = [
			"count" => $this->muteCount,
			"object" => $this->mute,
		];
		$data["ban"] = [
			"count" => $this->banCount,
			"object" => $this->ban,
		];
		return parent::saveData($data);
	}

	/**
	 * Function setBanned
	 * @param bool $value
	 * @return void
	 * @deprecated
	 * @use SecurityPlayer::ban(...)
	 */
	public function setBanned(bool $value){
	}

	/**
	 * Function ban
	 * @param SecurityPlayer $moderator
	 * @param string $reason
	 * @param int $until
	 * @param bool $permanent
	 * @return void
	 */
	public function ban(SecurityPlayer $moderator, string $reason, int $until, bool $permanent = false): void{
		$this->banCount++;
		$this->ban = new Ban($moderator->getUniqueId()->toString(), $moderator->getDisplayName(), ($this->banCount > 3 ? $this->translate("x-security.message.ban.tooMuch") : $reason), $until, ($this->banCount > 3 ? true : $permanent));
		$this->setImmobile(true);

		if (!is_null($this->ban)) {
			$this->close($this->translate($this->ban->getReason()));
		}
	}

	/**
	 * Function isBanned
	 * @return bool
	 */
	public function isBanned(): bool{
		return !is_null($this->ban);
	}

	/**
	 * Function setMuted
	 * @param bool $value
	 * @return void
	 * @deprecated
	 * @use SecurityPlayer::mute(...)
	 */
	public function setMuted(bool $value){
	}

	/**
	 * Function mute
	 * @param SecurityPlayer $moderator
	 * @param string $reason
	 * @param int $until
	 * @param bool $permanent
	 * @return void
	 */
	public function mute(SecurityPlayer $moderator, string $reason, int $until, bool $permanent = false): void{
		$this->banCount++;
		$this->ban = new Ban($moderator->getUniqueId()->toString(), $moderator->getDisplayName(), ($this->banCount > 3 ? $this->translate("x-security.message.ban.tooMuch") : $reason), $until, ($this->banCount > 3 ? true : $permanent));
		$this->setImmobile(true);

		if (!is_null($this->ban)) {
			$this->close($this->translate($this->ban->getReason()));
		}
	}

	/**
	 * Function isMuted
	 * @return bool
	 */
	public function isMuted(): bool{
		return !is_null($this->mute);
	}
}
