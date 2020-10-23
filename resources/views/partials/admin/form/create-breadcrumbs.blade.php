<div class="row align-items-center">
  <!-- Breadcrumbs-->
  <div class="col-sm-6">
    <h4 class="page-title">Crete {{ ucfirst($featureName) }}</h4>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
      <li class="breadcrumb-item">
        <a href="/admin/{{ \Str::plural($featureName) }}">{{ ucfirst(\Str::plural($featureName)) }}</a>
      </li>
      <li class="breadcrumb-item active">Create {{ ucfirst($featureName) }}</li>
    </ol>
  </div>
  <!--menu-->
</div>