<div class="form-floating ">
    <!--Input-->
    <input 
    type="{{$type}}" 
    class="form-control @error($name) is-invalid @enderror "
    id="{{$id}}" 
    placeholder="{{$placeholder}}"
    {{$isRequired ? 'required' : ''}} 
    value="{{$value}}"
    name="{{$name}}"
    >

    <!--Label-->
    <label for="{{$name}}">{{$label}}</label>
    <!--Error message-->
    @error($name)
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
  