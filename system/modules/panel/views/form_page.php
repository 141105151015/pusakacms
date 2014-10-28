<form action="#" class="panel-form">
	<div class="row heading">
		<div class="col-md-6">
			<h1>NEW PAGE</h1>
		</div>
		<div class="col-md-6 align-right">
			<button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save changes</button>
		</div>
	</div>
	<ul class="nav nav-tabs" role="tablist">
		<li class="active"><a href="#main" role="tab" data-toggle="tab">Main</a></li>
		<li><a href="#optional" role="tab" data-toggle="tab">Optional</a></li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<div class="tab-pane active" id="main">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="title">Title <small>page title</small></label>
						<input type="text" class="form-control" name="title">
					</div>		
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="slug">Slug <small>page url will become {{ helpers.site_title }}</small></label>
						<input type="text" class="form-control" name="slug">
					</div>		
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="slug">Parent <small>Parent page</small></label>
						<select class="form-control" name="format" id="layout">
							<option value="docs">Docs</option>
							<option value="docs/apa-itu-pusaka">Docs > Apa itu Pusaka</option>
							<option value="about">About</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="title">Layout <small>page layout file</small></label>
						<select class="form-control" name="layout" id="layout">
							<option value="auto">auto</option>
							<option value="full-width">full-width</option>
							<option value="sidebar-right">sidebar-right</option>
						</select>
					</div>		
				</div>
			</div>

			<div class="form-group">
				<label for="content">Content</label>	
				<textarea id="pagedownMe" class="form-control" rows="10">
					# This is the *first* editor.

					Just plain **Markdown**, except that the input is sanitized:

					<marquee>I'm the ghost from the past!</marquee>
				</textarea>
			</div>
		</div>

		<div class="tab-pane" id="optional">
			<div class="form-group">
				<label for="meta-desc">Meta Description <small>optional</small></label>
				<textarea name="meta-desc" class="form-control" rows="3"></textarea>
			</div>
			<div class="form-group">
				<label for="meta-keyword">Meta Keyword <small>optional</small></label>
				<input type="meta-keyword" class="form-control">
			</div>
		</div>
	</div>

</form>

<script type="text/javascript">
	(function() {
		$("textarea#pagedownMe").pagedownBootstrap();
		$('.wmd-preview').addClass('well').css('display', 'none');
	})();
</script>