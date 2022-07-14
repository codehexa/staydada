<?php
include  $_SERVER["DOCUMENT_ROOT"]."/zbackoffice/include/head.php";

$tbl = "com_code";

$recordcnt="30";
$searchand = " AND gubun='$mode'";

if ($strsearch){
    $searchand .= " AND $search like '%$strsearch%'";
}

$cnt = QRY_CNT($tbl,$searchand);
$totalpage = QRY_TOTALPAGE($cnt,$recordcnt);
$result =QRY_LIST($tbl,$recordcnt,$page,$searchand," sort ASC ");
?>

<div id="contents">
    <div class="tit"><?php echo $title_text?>
        <div class="path">
            <img src="../img/icon-home.png">
            HOME<img src="../img/arr.png"><?php echo $menu_text1?><img src="../img/arr.png"><?php echo $menu_text2?><img src="../img/arr.png"><?php echo $title_text?>
        </div>
    </div>
    <div class="content">       
        <div class="tit"><?php echo $title_text ?> 등록</div>
        <div class="main-box">
            <form name="f" method="post" id="f">
            <input type="hidden" name="typ" value="<?php echo $typ?>">
            <input type="hidden" name="idx" value="<?php echo $idx?>">
            <input type="hidden" name="mode" value="<?php echo $mode?>">
            <input type="hidden" name="write_url" value="/zbackoffice/change/comcode.php">
            <table class="write">
                <tr>
                    <th width="25%" class="ce">정렬순서</th>
                    <th width="25%" class="ce">코드명</th>
                    <th width="25%" class="ce">사용여부</th>
                    <th width="25%" class="ce">관리</th>
                </tr>
                <tr>
                    <td class="ce" style="padding-left:50px;"><input type="text" name="sort" class="w120" maxlength="2" numberOnly ></td>
                    <td class="ce"><input type="text" name="code_name" class="w300" maxlength="50"></td>
                    <td class="ce" style="padding-left:60px;"><select name="useyn" class="w120">
                        <option value="1" >사용</option>
                        <option value="0">사용안함</option>
                    </select></td>
                    <td class="ce" style="padding-left:60px;"><a href="javascript: check('f','write','저장');" class="btn blue">저장</a></td>
                </tr>
            </table>
            </form>     
            <br>
        </div>
        <div class="tit"><?php echo $title_text ?> 관리</div>
        <div class="main-box">          
            <table class="write">
                <tr>
                    <th width="12%">번호</th>
                    <th width="12%">정렬순서</th>
                    <th width="*">코드명</th>
                    <th width="30%">사용여부</th>
                    <th width="12%">관리</th>
                </tr>
           <?php
                if ($cnt==0){
            ?>
                <tr>
                    <td colspan="5" align="center">등록 된 자료가 없습니다</td>
                </tr>
           <?php
                }
                $ListNO=$cnt-(($page-1)*$recordcnt);

                while($row = mysqli_fetch_array($result)){
                    $idx = replace_out($row["idx"]);
                    $sort = replace_out($row["sort"]);
                    $code_name = replace_out($row["code_name"]);
                    $useyn = replace_out($row["useyn"]);
           ?>
                <form name='f<?php echo $idx?>' method="post">
                <input type="hidden" name="typ" value="">
                <input type="hidden" name="mode" value="<?php echo $mode?>">
                <input type="hidden" name="idx" value="<?php echo $idx?>">
                <input type="hidden" name="write_url" value="comcode.php">
                <tr>
                    <td style="padding-left:50px;"><?php echo $ListNO ?></td>
                    <td><input type="text" name="sort" class="w80" maxlength="2" value="<?php echo $sort?>" numberOnly></td>
                    <td><input type="text" name="code_name" class="w220" maxlength="50" value="<?php echo $code_name?>"></td>
                    <td><select name="useyn" class="w120">
                        <option value="1" <?if($useyn=="1"){?>selected<?}?>>사용</option>
                        <option value="0" <?if($useyn=="0"){?>selected<?}?>>사용안함</option>
                    </select></td>
                    <td><a href="javascript: check('f<?php echo $idx?>','edit','수정');" class="btn line">수정</a>
                    <!--<a href="javascript: check('f<?php echo $idx?>','del','삭제');" class="btn line">삭제</a>--></td>
                </tr>
                </form>
            <?php
                    $ListNO--;
                }
            ?>
            </table>
            <br>
        </div>
        
    </div>
</div>
<?include  $_SERVER["DOCUMENT_ROOT"]."/zbackoffice/include/footer.php";?>
<iframe id="_hiddenFrm" name="_hiddenFrm" width="500" height="400" frameborder="1" marginheight="0" marginwidth="0" scrolling="yes" style="visible:false;display:none;" title="빈프레임"></iframe>
</div>

<script type="text/javascript">
    function check(obj,typ,txt){
        var f = eval("document."+obj);
        if (nullchk(f.code_name,"코드명을 입력하세요.")== false) return ;
        
        f.typ.value=typ;
        f.target = "_self";
        f.action = "./comcode_proc.php";
        f.submit();
    }
</script>
