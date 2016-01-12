function addToShopingcart(article_id){
    $.get('index.php?r=site/addToShopingcart',{article_id:article_id},function(res){
        alert(res.message);
    },'json');
}