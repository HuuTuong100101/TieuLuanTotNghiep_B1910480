<div class="row filter box-filter">
    <form class="form-inline" action="{{route('filter')}}" method="GET">
       <div class="form-group">
         <select name="category" id="" class="form-control select-filter">
             <option value="">-- Chọn danh mục --</option>
            @foreach ($categories as $category)
                <option {{ isset($_GET['category']) && $_GET['category'] == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->title}}</option>
             @endforeach
         </select>
       </div>
       <div class="form-group">
          <select name="genre" id="" class="form-control select-filter">
             <option value="">-- Chọn thể loại --</option>
             @foreach ($genres as $genre)
                <option {{ isset($_GET['genre']) && $_GET['genre'] == $genre->id ? 'selected' : ''}} value="{{$genre->id}}">{{$genre->title}}</option>
             @endforeach
         </select>
       </div>
       <div class="form-group">
          <select name="country" id="" class="form-control select-filter">
             <option value="">-- Chọn quốc gia --</option>
             @foreach ($countries as $country)
                <option {{ isset($_GET['country']) && $_GET['country'] == $country->id ? 'selected' : ''}} value="{{$country->id}}">{{$country->title}}</option>
             @endforeach
         </select>
       </div>
       <div class="form-group">
          <select name="year" id="" class="form-control select-filter">
             <option value="">-- Chọn năm phát hành --</option>
             @for ($i=2023; $i>=2000; $i--)
                <option {{ isset($_GET['year']) && $_GET['year'] == $i ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
             @endfor
         </select>
       </div>
       <button type="submit" class="btn btn-filter btn-danger">Filter</button>
     </form>
 </div>