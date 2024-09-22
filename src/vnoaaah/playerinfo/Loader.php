<?php
/*

@author JavaSnippets
@date 22.09.2024
@project PlayerInfo

@copyright © 2024 Noah Weixelbaum (JavaSnippets) - Alle Rechte vorbehalten.

*/

namespace vnoaaah\playerinfo;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use vnoaaah\playerinfo\commands\ListPlayersCommand;

class Loader extends PluginBase {

    private static Loader $instance;

    public function onLoad(): void
    {
        self::$instance = $this;
    }

    public function onEnable(): void
    {
        $this->getServer()->getLogger()->info("Plugin has been enabled.");

        $map = Server::getInstance()->getCommandMap();
        $map->registerAll("playerinfo", [
            new ListPlayersCommand()
        ]);
    }

    public function onDisable(): void
    {
        $this->getServer()->getLogger()->info("Plugin has been disabled.");
    }

    public static function getInstance(): self
    {
        return self::$instance;
    }

}