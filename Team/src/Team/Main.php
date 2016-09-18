<?php
namespace Team;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
class Main extends PluginBase implements Listener {
	public function onEnable() {
        	$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
//今回は、前回コア破壊プラグインを作ったので、チーム分けのプラグインを作ることにしました。なお、再起動後にチームはリセットされます。
	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$name = $player->getName();
		if(!isset($this->team[$name])){//もしチームに入ってなかったら
			$r = mt_rand(0, 3);//$rはランダムで0〜3の数字が当てられます
			switch($r){//今までif()を使っていましたが今回はswitch()という関数を使ってみます。ifを使用した時、elseif,elseif,elseif,,,となって分かりにくいコードになる場合に使います。switchの方が動作も軽いです。
				case "0"://もし$rが0だったら...最後はセミコロン(;)ではなくコロン(:)なのでお気をつけ下さい
					$player->sendMessage("あなたはAチームです");
					$this->team[$name] = "A";//Aチームに設定します
				break;//処理を終わらせます。書かない場合これより下の処理もされます(わざと書かないこともあります)。
				case "1"://以下、上と同じ処理です
					$player->sendMessage("あなたはBチームです");
					$this->team[$name] = "B";
				break;
				case "2":
					$player->sendMessage("あなたはCチームです");
					$this->team[$name] = "C";
				break;
				case "3":
					$player->sendMessage("あなたはDチームです");
					$this->team[$name] = "D";
				break;
				default://もし$rが上の条件(0,1,2,3)以外だった場合に処理がされます。今回$rは必ず0〜3なのでここの処理は行われませんが、参考として書かせて頂きます。
				$player->sendMessage("エラー");
			}
		}else{//もしすでにチームに入っていたら
			$player->sendMessage("あなたは" . $this->team[$name] . "チームです");
		}
	}
}
