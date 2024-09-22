<?php
/*

@author JavaSnippets
@date 22.09.2024
@project PlayerInfo

@copyright © 2024 Noah Weixelbaum (JavaSnippets) - Alle Rechte vorbehalten.

*/

namespace vnoaaah\playerinfo\forms;

use dktapps\pmforms\CustomForm;
use dktapps\pmforms\element\Dropdown;
use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\player\Player;
use pocketmine\Server;

class PlayerListForm extends CustomForm {

    private Player $player;

    public function __construct(Player $player)
    {
        $players = count(Server::getInstance()->getOnlinePlayers());
        $playerNames = [];

        foreach ($players as $onlinePlayer) {
            $playerNames[] = $onlinePlayer->getName();
        }

        if (empty($playerNames)) {
            $player->sendMessage("No Player is Online");
            return;
        }

        parent::__construct("Online Players", [
            new Dropdown("player_dropdown", "Choose a Player:", $playerNames),
        ],
        function (Player $player, array $data) use ($playerNames): void {
            if (!isset($data["player_dropdown"])) {
                $player->sendMessage("No Choice");
                return;
            }
            $selectedPlayerName = $playerNames[$data["player_dropdown"]];
            $player->sendMessage("You selected $selectedPlayerName.");
        },
        function (Player $player): void {
            $player->sendMessage("Form has been closed.");
        });
    }

}