
                    
               
<div class = "col-sm-6">
        <div class = "col-sm-12">
                @php if(isset($errors['first_name'][0])){ 
                   $error = '<b style="color:red;">'.$errors['first_name'][0].'</b>'; $class_form_group='has-danger';}else
                   {$error = ''; $class_form_group='';}@endphp 
               
               <div class="form-group bmd-form-group @php echo $class_form_group; @endphp">
                   <label class="label-control">* Nome</label>
                   <input type="text" class="form-control" name = "first_name" value ="@php if(isset($data['first_name'])){ echo $data['first_name'];} @endphp">
               </div>
               @php echo $error; @endphp
           </div>

           <div class = "col-sm-12">
                @php if(isset($errors['last_name'][0])){ 
                        $error = '<b style="color:red;">'.$errors['last_name'][0].'</b>'; $class_form_group='has-danger';}else
                        {$error = ''; $class_form_group='';}@endphp 

                <div class="form-group bmd-form-group @php echo $class_form_group; @endphp">
                        <label class="label-control">* Sobrenome</label>
                        <input type="text" class="form-control" name = "last_name" value ="@php if(isset($data['last_name'])){ echo $data['last_name'];} @endphp">
                </div>
                @php echo $error; @endphp
            </div>

            <div class = "col-sm-12">
                     @php if(isset($errors['email'][0])){ 
                        $error = '<b style="color:red;">'.$errors['email'][0].'</b>'; $class_form_group='has-danger';}else
                        {$error = ''; $class_form_group='';}@endphp 

                    <div class="form-group bmd-form-group @php echo $class_form_group; @endphp">
                        <label class="label-control">* E-mail</label>
                        <input type  = "email" name  = "email" class = "form-control" value = "@php if(isset($data['email'])){ echo $data['email'];} @endphp" />
                    </div>
                    @php echo $error; @endphp
            </div> 


            <div class = "col-sm-12">
                    @php if(isset($errors['password'][0])){ 
                        $error = '<b style="color:red;">'.$errors['password'][0].'</b>'; $class_form_group='has-danger';}else
                        {$error = ''; $class_form_group='';}@endphp 

                    <div class="form-group bmd-form-group @php echo $class_form_group; @endphp">
                        <label class="label-control">* Senha</label>
                        <input name  = "password" type  = "password" class = "form-control" value = "@php if(isset($data['password'])){ echo $data['password'];} @endphp" />
                    </div>
                    @php echo $error; @endphp
            </div> 

            <div class = "col-sm-12">
                    @php if(isset($errors['date_birth'][0])){ 
                        $error = '<b style="color:red;">'.$errors['date_birth'][0].'</b>'; $class_form_group='has-danger';}else
                        {$error = ''; $class_form_group='';}@endphp 
 

                    <div class="form-group bmd-form-group @php echo $class_form_group; @endphp">
                        <label class="label-control">* Data de Nascimento</label>
                        <input  name  = "date_birth" autocomplete="off" type="text" class = "form-control datetimepicker" value = "@php if(isset($data['date_birth'])){ echo $data['date_birth'];} @endphp" />
                    </div>
                    @php echo $error; @endphp
            </div> 
</div>

<div class = "col-sm-6">

        <div class = "col-sm-12"><br><center>Foto de Perfil<center><br></div>

        <div class = "col-sm-12">
                    <center>​
                        <picture>
                            <img src="{{ URL::to('/') }}/imagens/avatar.png" id="picture_avatar_img"
                            style="width: 300; height: 200 ;  border-radius: 50%; cursor: pointer" class="img-fluid img-thumbnail" alt="...">
                        </picture>
                    </center>
                      
        </div>

        <div class = "col-sm-12" style="visibility: hidden">
                <center>​
                    <span class="btn btn-raised btn-round btn-primary btn-file"> 
                            <input type="file" name="picture_avatar" id="picture_avatar" onchange="readURL(this);"/>
                    </span>
                </center>
        </div>
</div>
 
<script type="text/javascript">
    $(function () { 
        var fileupload = $("#picture_avatar"); 
        var image = $("#picture_avatar_img");
        image.click(function () { 
            fileupload.click();
        }); 
    });

    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#picture_avatar_img')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
                 
   