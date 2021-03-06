<?php echo View::make('header'); ?>
<div class="page-header">
	<h2 class="text-center">净值报告</h2>
</div>
<?php if(isset($product)){ ?>
<form class="form-horizontal" role="form" method="post" action="<?=url(isset($quote) ? 'product/' . $product->id . '/quote/' . $quote->id : 'product/' . $product->id . '/quote')?>">
	<?php if(isset($quote)){ ?><input type="hidden" name="_method" value="PUT"><?php } ?>
	<div class="form-group">
		<label class="control-label col-sm-2">日期*</label>
		<div class="col-sm-10">
			<input type="date" name="date" value="<?=isset($quote) ? $quote->date->toDateString() : date('Y-m-d')?>" required class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">市值</label>
		<div class="col-sm-10">
			<div class="input-group">
				<div class="input-group-addon">人民币</div>
				<input type="number" step="0.01" min="0" name="cap" value="<?=@$quote->cap_for_reference ? '' : @$quote->cap?>" class="form-control">
				<div class="input-group-addon">元</div>
			</div>
			<div class="help-block">净值与市值可以任意填一项，另一项将计算参考值</div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">单位净值</label>
		<div class="col-sm-10">
			<input type="number" step="0.0001" min="0" name="value" value="<?=@$quote->value_for_reference ? '' : @$quote->value?>" class="form-control">
		</div>
	</div>
	<?php if($product->type === '结构化'){ ?>
	<div class="form-group">
		<label class="control-label col-sm-2">劣后净值*</label>
		<div class="col-sm-10">
			<input type="number" step="0.0001" min="0" name="value_inferior" value="<?=@$quote->value_inferior_for_reference ? '' : @$quote->value_inferior?>" class="form-control">
		</div>
	</div>
	<?php } ?>
	<div class="form-group">
		<label class="control-label col-sm-2">备注</label>
		<div class="col-sm-10">
			<textarea name="comments" value="<?=@$quote->comments?>" class="form-control"></textarea>
		</div>
	</div>
	<button type="submit" class="btn btn-primary btn-lg">提交</button>
	<button type="submit" name="continue" value="1" class="btn btn-default btn-lg">提交并继续</button>
	<hr>
	<?php if(isset($quote)){ ?>
	<button type="submit" name="remove" value="1" class="btn btn-danger btn-lg">删除此报价</button>
	<?php } ?>
	<a href="<?=url('product/' . $product->id . '/quote')?>" class="btn btn-info btn-lg">查看历史报价</a>
</form>
<?php } else{ ?>
<ul class="nav nav-pills nav-stacked">
	<?php foreach($products as $product){ ?>
	<li role="presentation"><a href="<?=url('product/' . $product->id . '/quote/create')?>"><?=$product->name?>, <?=$product->type?></a></li>
	<?php } ?>
	<?php if(count($products) === 0){ ?>
	<div class="alert alert-warning">请先添加客户产品</div>
	<?php } ?>
</ul>
<?php } ?>
<?php echo View::make('footer'); ?>
