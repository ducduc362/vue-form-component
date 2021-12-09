@extends('template.app')

@section('content')

<form-wrapper group="update-form" v-cloak>
  <div slot-scope="props">
    <fieldset class="fieldset">
      <legend>Personal details</legend>
      <div class="grid-x grid-margin-x">
        <div class="cell small-12 medium-6">
          <text-input 
            :group="props.group" 
            name="first_name" 
            v-model="props.fields.first_name" 
            :focus="true" placeholder="First name" 
            maxlength="9" autocomplete="given-name" 
            :validation="{
              'min:2': 'Minium length 2 chars.',
              'max:30': 'Maximum length 30 chars.'
            }"
          >
          </text-input>
        </div>

        <div class="cell small-12 medium-6">
          <text-input 
            :group="props.group" 
            name="last_name" 
            v-model="props.fields.last_name" 
            :focus="true" placeholder="Last name" 
            maxlength="9" autocomplete="family-name" 
            :validation="['min:2', 'max:30']"
          >
          </text-input>
        </div>
      </div>
    </fieldset>
  </div>
</form-wrapper>

@endsection

@push('footer-scripts')
<script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
@endpush