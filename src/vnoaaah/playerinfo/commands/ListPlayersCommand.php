<?php
/*

@author JavaSnippets
@date 22.09.2024
@project PlayerInfo

@copyright © 2024 Noah Weixelbaum (JavaSnippets) - Alle Rechte vorbehalten.

*/

namespace vnoaaah\playerinfo\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use vnoaaah\playerinfo\forms\PlayerListForm;

class ListPlayersCommand extends Command {

    public function __construct()
    {
        parent::__construct("listplayersform", "List Playrs", "/listplayersform");
        $this->setPermission("form.list");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if (!$sender instanceof Player) return;
        if ($sender->hasPermission("form.list")) {
            $p = $sender;
            $p->sendForm(new PlayerListForm($p));
        }
    }
}