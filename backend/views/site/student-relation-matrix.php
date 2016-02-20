<?php
    use yii\helpers\Html;
?>


<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th> choser\chosen </th>
                <?php foreach($ids as $id){
                    echo "<th>$id</th>";
                 }
                ?>
            </tr>


        </thead>


        <?php
            for($i = 0; $i < count($ids) ; $i++){
                $id = $ids[$i];
                echo "<tr>
                         <th>$id</th>";
                foreach($matrix[$i] as $item){
                    echo "<th> $item </th>";
                }
                echo "</tr>";
            }
        ?>
    </table>


    <?= Html::a('Save to Excel', ['site/relation-excel'], ['class' => 'btn btn-primary']) ?>
</div>