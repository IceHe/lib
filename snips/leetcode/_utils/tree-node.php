<?php

class TreeNode {
    public $val = null;
    public $left = null;
    public $right = null;
    public function __construct($value = null) { $this->val = $value; }

    public static function build(array $ary, $skipNull = true): ?TreeNode {
        $len = count($ary);
        if ($len === 0) {
            return null;
        }

        $root = null;

        $prevFloor = [];
        $curFloor = [];

        $maxCurFloorCnt = 1;
        $curFloorCnt = 0;

        foreach ($ary as $v) {
            if ($v === null) {
                $curFloorCnt++;
                continue;
            }

            $node = new TreeNode($v);
            array_push($curFloor, $node);
            $curFloorCnt++;

            // init once
            if ($root === null) {
                $root = $node;
            }

            // do after 1st iteration
            if (!empty($prevFloor)) {
                $parentNodeIdx = floor(($curFloorCnt - 1) / 2);
                $parentNode = $prevFloor[$parentNodeIdx] ?? null;

                if ($parentNode !== null) {
                    if (($curFloorCnt - 1) % 2 == 0) {
                        $parentNode->left = $node;
                    } else {
                        $parentNode->right = $node;
                    }
                }
            }

            if ($curFloorCnt === $maxCurFloorCnt) {
                $prevFloor = $curFloor;
                $curFloor = [];

                $maxCurFloorCnt = count($prevFloor) * 2;
                $curFloorCnt = 0;
            }
        }

        return $root;
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

////$treeAry = [4,2,7,1,8,6,9];
////$treeAry = [4,2,7,1,null,null,9];
//$treeAry = [5,3,6,2,4,null,8,1,null,null,null,7,9];
//$treeNode = TreeNode::build($treeAry);
//TreeNode::traverse($treeNode);
