<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="{{route('home')}}">Dashboard</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{route('category.index')}}">Danh mục phim</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('genre.index')}}">Thể loại</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('country.index')}}">Quốc gia</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('movie.index')}}">Phim</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('espisode.create')}}">Tập phim</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
</nav>