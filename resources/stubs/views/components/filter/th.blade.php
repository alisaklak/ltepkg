<?php
if(isset($allowedSorts) && isset($field['name']) && in_array($field['name'],$allowedSorts)){
$icon='<i class="fas fa-sort" style="color:#BCBCBC"></i>';
$url=request()->fullUrlWithQuery(['sort' => $field['name']]);
if (isset($_GET['sort'])) {
if ($_GET['sort'] == $field['name'] ) {
$icon='<i class="fas fa-sort-down    "></i>';
$url=request()->fullUrlWithQuery(['sort' => '-'.$field['name']]);
}elseif($_GET['sort'] == '-'.$field['name']){
$icon='<i class="fas fa-sort-up    "></i>';
}
}
?>
<th class="{{ $field['class'] ?? ''}}" >
    <a href="{{$url}}" class="d-block text-dark">
        {{!isset($field['label']) ? strtoupper($field['name']) : $field['label']}} {!!$icon!!}
    </a>
</th>
<?php
}else{
?>
<th>
    {{!isset($field['label']) ? strtoupper($field['name']) : $field['label']}}
</th>
<?php
}
?>
