<?php
namespace Core;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
class Main extends PluginBase implements Listener {
	public function onEnable() {
        	$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
//今回は、使えるとものすごく便利な機能、「配列」を使ったコアプラグインです。
	public function onBreak(BlockBreakEvent $event){//ブロックを壊した時
		$player = $event->getPlayer();//ブロックを壊したプレイヤーを取得
		$block = $event->getBlock();//壊したブロックを取得
		if($block->getID() == "159"){//もしブロックがID159だったら〜
			$x = $block->x;//blockのx座標
			$y = $block->y;//blockのy座標
			$z = $block->z;//blockのz座標
			if(!isset($this->core[$x][$y][$z])){//「$this->(なんとか)」は、イメージはファイルを作らないconfigです。ただし、再起動すると消去されます。[$x][$y][$z]は配列と言い、マンションの部屋のように、$this->coreマンションの$x館、$y階、$z番のような感じです(説明が下手ですごめんなさい)。
				$this->core[$x][$y][$z] = 30;//$x,$y,$zにあるコアのHPを30にします。
			}
			$this->core[$x][$y][$z]--;//コアのHPを1減らします。
			$player->sendMessage("コアを削りました(残り" . $this->core[$x][$y][$z] . ")");
			if($this->core[$x][$y][$z] == 0){//コアHPが0だったら
				$player->sendMessage("コアを破壊しました");
				$this->core[$x][$y][$z] = 30;//もし次のコアが置かれた時のためにHPを元に戻します。
			}else{//コアHPが0でなかったら
				$event->setCancelled();//ブロックを壊したイベントをキャンセルします。つまり、ブロックは壊されません。
			}
		}
	}
}
