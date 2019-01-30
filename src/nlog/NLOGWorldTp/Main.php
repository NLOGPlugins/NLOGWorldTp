<?php

namespace nlog\NLOGWorldTp;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\level\Level;

class Main extends PluginBase implements Listener{

 	 public function onEnable(){
    	$this->getServer()->getPluginManager()->registerEvents($this, $this);
    	$this->getLogger()->notice("월드이동 플러그인");
    	$this->getLogger()->info(TextFormat::AQUA . "Made by NLOG (pmmp.me)");
 	 }
 	 
 	 public function onCommand(CommandSender $sender,Command $cmd,string $label,array $args): bool {
 	 	
 	 	$prefix = "§o§b[ 알림 ] §7";
 	 	
 	 	/*
 	 	 * /월드이동 <월드 이름>
 	 	 *  $cmd $args[0]
 	 	 */
 	 	
 	 	if (strtolower($cmd) === "worldtp") {
 	 		
 	 		if (!$sender instanceof Player) {
 	 			$sender->sendMessage($prefix."인게임 내에서 입력해주세요.");
 	 			return true;
 	 		}
 	 		if ($args[0] == null) {
 	 			$sender->sendMessage($prefix."/worldtp <월드명>");
 	 			return true;
 	 		}
 	 		
 	 		$world = strtolower($args[0]);
 	 		
 	 		if ($this->getServer()->getLevelManager()->getLevelByName(strtolower($args[0])) == null) {
 	 			if (!file_exists($this->getServer()->getDataPath() . "worlds/" . $world)) {
 	 				$sender->sendMessage($prefix."올바른 월드 이름을 입력해주세요.");
 	 				return true;
 	 			}else{
 	 				$this->getServer()->getLevelManager()->loadLevel($world);
 	 			}
 	 		}
 	 		
 	 		$name = $sender->getName();
 	 		$player = $this->getServer()->getPlayerExact($name);
 	 		
 	 		$player->teleport($this->getServer()->getLevelManager()->getLevelByName($world)->getSafeSpawn());
 	 		$player->sendTip($prefix."월드 '".$world."' 으(로) 이동했습니다.");
 	 		
 	 	}
 	 	
 	 	if (strtolower($cmd) === "월드이동") {
 	 		 
 	 		if (!$sender instanceof Player) {
 	 			$sender->sendMessage($prefix."인게임 내에서 입력해주세요.");
 	 			return true;
 	 		}
 	 		if ($args[0] == null) {
 	 			$sender->sendMessage($prefix."/월드이동 <월드명>");
 	 			return true;
 	 		}
 	 		 
 	 		$world = strtolower($args[0]);
 	 		 
 	 		if ($this->getServer()->getLevelManager()->getLevelByName(strtolower($args[0])) == null) {
 	 			if (!file_exists($this->getServer()->getDataPath() . "worlds/" . $world)) {
 	 				$sender->sendMessage($prefix."올바른 월드 이름을 입력해주세요.\n/worldlist 나 /월드목록 으로 월드의 목록을 확인할 수 있습니다.");
 	 				return true;
 	 			}else{
 	 				$this->getServer()->getLevelManager()->loadLevel($world);
 	 			}
 	 		}
 	 		 
 	 		$name = $sender->getName();
 	 		$player = $this->getServer()->getPlayerExact($name);
 	 		 
 	 		$player->teleport($this->getServer()->getLevelManager()->getLevelByName($world)->getSafeSpawn());
 	 		$player->sendTip($prefix."월드 '".$world."' 으(로) 이동했습니다.");
 	 		 
 	 	}
 	 	
 	 	if (strtolower($cmd) === "worldlist") {
			
 	 		foreach ($this->getServer()->getLevelManager()->getLevels() as $level) {
 	 			$name = "";
 	 			$name .= $level ? TextFormat::GREEN : TextFormat::RED;
 	 			$name .= $level->getName();
 	 			
 	 			
 	 			$player = TextFormat::WHITE.count($level->getPlayers());
 	 			$sender->sendMessage($prefix."월드명 : ".$name."§f | §7이 월드에 접속한 플레이어 수 : ".$player);
 	 		}
 	 	}
		
		if (strtolower($cmd) === "월드목록") {
			
 	 		foreach ($this->getServer()->getLevelManager()->getLevels() as $level) {
 	 			$name = "";
 	 			$name .= $level ? TextFormat::GREEN : TextFormat::RED;
 	 			$name .= $level->getName();
 	 			
 	 			
 	 			$player = TextFormat::WHITE.count($level->getPlayers());
 	 			$sender->sendMessage($prefix."월드명 : ".$name."§f | §7이 월드에 접속한 플레이어 수 : ".$player);
 	 		}
 	 	}
		 return true;
 	 }
  }
?>
