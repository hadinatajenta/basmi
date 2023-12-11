<div class="form-floating">
    <select class="form-select" id="{{$id}}" aria-label="{{$label}}" name="{{$name}}">
      <option selected value="0" disabled>Open this select menu</option>
      @foreach ($options as $value => $text)
          <option value="{{$value}}" {{$selectedvalue == $value ? 'selected' : ''}} > {{$text}}</option>
      @endforeach
    </select>
    <label for="{{$id}}">{{$label}}</label>
</div>