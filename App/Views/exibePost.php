<?php use App\Init; ?>


<br><br><br>
<a href="<?php echo Init::$urlRoot.'/'.$post['nickAnimal']?>"><?php echo $post['nomeAnimal']?></a><br>
<span class="postDate"><?php echo $post['dataStatus']?></span><br>
<?php echo $post['conteudoPost']?>
<br>