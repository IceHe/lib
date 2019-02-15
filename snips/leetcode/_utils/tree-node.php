<?php

class TreeNode {
    public $val = null;
    public $left = null;
    public $right = null;
    public function __construct($value) { $this->val = $value; }

    public static function build(array $ary): ?TreeNode {
        $len = count($ary);
        if ($len === 0) {
            return null;
        }

        $nodeAry = [];
        foreach ($ary as $i => $v) {
            if ($v === null) {
                continue;
            }

            $newNode = new TreeNode($v);
            $nodeAry[$i] = $newNode;

            $parentIndex = floor(($i - 1) / 2);
            if ($parentIndex < 0) {
                continue;
            }

            if ($i % 2 === 1) {
                // 奇数 -> 左节点
                $nodeAry[$parentIndex]->left = $newNode;
            } else {
                // 偶数 -> 右节点
                $nodeAry[$parentIndex]->right = $newNode;
            }
        }

        return $nodeAry[0];
    }

    private const INDENT = '  ';

    public static function traverse(?TreeNode $treeNode, int $depth = 0): void {
        for ($i = 0; $i < $depth; $i++) {
            echo self::INDENT;
        }

        if ($treeNode === null) {
            echo "null\n";
            return;
        }

        echo ($treeNode->val ?? 'null')."\n";

        if (is_null($treeNode->left) && is_null($treeNode->right)) {
            return;
        }

        self::traverse($treeNode->left ?? null, $depth + 1);
        self::traverse($treeNode->right ?? null, $depth + 1);

//        if (!is_null($treeNode->right)) {
//            self::traverse($treeNode->right, $depth + 1);
//        }
    }
}

// for test
//$treeAry = [4,2,7,1,8,6,9];
$treeAry = [4,2,7,1,null,null,9];
$treeNode = TreeNode::build($treeAry);
TreeNode::traverse($treeNode);
