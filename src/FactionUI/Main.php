<?php

namespace FactionUI;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener {
	
    public function onEnable() {
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		if($api === null){
			$this->getServer()->getPluginManager()->disablePlugin($this);			
		}
    }
	
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
		switch($cmd->getName()){
			case "factionui":
				if($sender instanceof Player) {
					$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
					$form = $api->createSimpleForm(function (Player $sender, ?int $data){
					

						switch($data){
							case 0:
								$this->getServer()->dispatchCommand($sender, "f topfactions");
		
                    		return true;
							break;
              
                            case 1:
								$this->getServer()->getCommandMap()->dispatch($sender, "f home");
							return true;
							break;

                            case 2:
								$this->getServer()->getCommandMap()->dispatch($sender, "f chat");
							return true;
							break;
							
							
                          case 3:
								$this->getServer()->getCommandMap()->dispatch($sender, "f allychat");
							return true;
							break;	
			
                          case 4:
								$this->getServer()->getCommandMap()->dispatch($sender, "f leave");
							return true;
							break;	

                          case 5:
								$this->getServer()->getCommandMap()->dispatch($sender, "f del");
							return true;
							break;	
						}
					});
					$form->setTitle(TextFormat::GOLD . "Faction Utils");
					$form->setContent("Comandi utili per Fazioni");
					$form->addButton(TextFormat::BOLD . "Top Fazioni");
                    $form->addButton(TextFormat::BOLD . "Home Fazione");
                    $form->addButton(TextFormat::BOLD . "Modalità Chat Fazione");
                    $form->addButton(TextFormat::BOLD . "Modalità Chat Alleati");
					$form->addButton(TextFormat::BOLD . "Esci dalla fazione");
                    $form->addButton(TextFormat::BOLD . TextFormat::RED . "Elimina la fazione");
					
					$form->sendToPlayer($sender);
				}
				else{
					$sender->sendMessage(TextFormat::RED . "Use this Command in-game.");
					return true;
				}
			break;
		
    }
}
}