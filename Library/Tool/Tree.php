<?php
class Tool_Tree
{

    /**
     * 把返回的数据集转换成Tree
     *
     * @param array $list 要转换的数据集
     * @param string $pk 主键字段
     * @param string $pid 父级字段
     * @param string $child 子级字段
     * @param mixed $root  无父级的父级字段值
     * @return array
     */
    public static function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = 'children', $root = 0)
    {
        // 创建Tree
        $tree = array();
        if (is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] = &$list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId =  $data[$pid];
                if ($root == $parentId) {
                    //找顶级部门,将现在遍历的顶级数组变量地址赋值给找到顶级分类
                    $tree[] = &$list[$key];
                } else {
                    //如果不是顶级部门,进来通过之前生成基于主键索引的找他上级
                    if (isset($refer[$parentId])) {
                        ////找到他上级
                        $parent = &$refer[$parentId]; //生成一个临时子集变量将他的父级数据地址写进去
                        $parent[$child][] = &$list[$key]; //将他写进带他爸爸数据的临
                        //时子集变量里,因为是变量地址,所以修改时修改是同步进行的,所以引用
                        //索引的地址改变后在数据源数组内也会跟着改变
                    }
                }
            }
        }
        return $tree;
    }
}

// 变量前+&解释

// 把实参，也就是这个变量的地址传给函数，函数内的操作会直接影响到函数外面的值。也就是说
//,$a=”1234″ $b=&a 这时不管修改$a还是$b 这时打印哪个变量都是打印出修改后的值

// $a= "123";
// $b = &$a;
// echo $a.' <- $a ------- $b -> '.$b.' <br>';
// $a = '234';
// echo $a.' <- $a ------- $b -> '.$b.' <br>';
// $a = '345';
// echo $a.' <- $a ------- $b -> '.$b.' <br>';
// exit;

// 123 <- $a ------- $b -> 123
// 234 <- $a ------- $b -> 234
// 345 <- $a ------- $b -> 345 
