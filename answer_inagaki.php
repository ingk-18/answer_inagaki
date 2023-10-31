<?php

function isBingo($bingoCard, $selectedWords, $size) {
    foreach ($selectedWords as $word) {
        // 選ばれた単語がビンゴカードに存在する場合はビンゴカードの単語を空文字にする
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if ($bingoCard[$i][$j] === $word) {
                    $bingoCard[$i][$j] = "";
                    break 2;
                }
            }
        }
        
        // 各列の値が全て空文字であればビンゴが成立していると判断する
        for ($i = 0; $i < $size; $i++) {
            // 横の列チェック
            if (implode("", $bingoCard[$i]) === "") return true;

            // 縦の列チェック
            $column = array_column($bingoCard, $i);
            if (implode("", $column) === "") return true;
        }

        // 左上から右下にかけての斜めをチェック
        $leftToRightDiagonal = [];
        for ($i = 0; $i < $size; $i++) {
            $leftToRightDiagonal[] = $bingoCard[$i][$i];
        }
        if (implode("", $leftToRightDiagonal) === "") return true;

        // 右上から左下にかけての斜めをチェック
        $rightToLeftDiagonal = [];
        for ($i = 0; $i < $size; $i++) {
            $rightToLeftDiagonal[] = $bingoCard[$i][$size - 1 - $i];
        }
        if (implode("", $rightToLeftDiagonal) === "") return true;
    }
    return false;
}

// ビンゴカードの作成
$size = intval(trim(fgets(STDIN)));
$bingoCard = [];
for ($i = 0; $i < $size; $i++) {
    $bingoCard[] = explode(" ", trim(fgets(STDIN)));
}

// 選ばれた単語を取得
$selectedNum = intval(trim(fgets(STDIN)));
$selectedWords = [];
for ($i = 0; $i < $selectedNum; $i++) {
    $selectedWords[] = trim(fgets(STDIN));
}

// ビンゴゲームを実行
if (isBingo($bingoCard, $selectedWords, $size)) {
    echo "yes";
} else {
    echo "no";
}

?>