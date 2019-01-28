<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class ImageUpload extends Controller
{
    /**
     * Upload image
     * @param Request $re
     * @return \Illuminate\Http\JsonResponse
     */
    public function iup(Request $re)
    {
        $file = $re->file('file');
        $fileName = date('YmdHis');
        $fileType = $file->getClientMimeType();
        if ($fileType == 'image/jpeg' || $fileType == 'image/png') {

            try {
                Input::file('file')->move(public_path() . '/uploads/', $fileName . "." . $file->getClientOriginalExtension());
                return response()->json(["status" => "success", "fileName" => $fileName . "." . $file->getClientOriginalExtension()]);
            } catch (\Exception $e) {
                echo "error";
            }
        } else {
            echo "invalid File";
        }
    }

    /**
     * Image upload for content
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function contentUpload(Request $request)
    {
        try {
            $img = $request->imageData;
            $fileName = date('YmdHis');
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $file = public_path() . '/uploads/' . $fileName . '.png';
            file_put_contents($file, $data);

//            convert png to jpg

            $jpgImage = imagecreatefrompng(public_path() . '/uploads/' . $fileName . '.png');
            imagejpeg($jpgImage, public_path() . '/uploads/' . $fileName . '.jpg', 90);
            imagedestroy($jpgImage);
            \File::delete(public_path() . '/uploads/' . $fileName . '.png');
            return response()->json([
                "status" => "success",
                "fileName" => $fileName . '.jpg'
            ]);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


    }


    /**
     * Show image for image editor
     */
    public function showImages()
    {
        $dir = scandir(public_path('/uploads'));
        foreach ($dir as $d => $images) {
            if (strpos($images, '.png') || strpos($images, '.jpg') || strpos($images, '.jpeg')) {
                echo "<div id='$images' class='row'>";

                echo "<div class='col-md-6'>";
                echo "<img height=600 width-500 src='" . url('/') . "/uploads/" . $images . "'>";
                echo "</div>";

                echo "<div class='col-md-6'>";
                echo "<div class='btn-group'>";
                echo "<button class='btn btn-success useIt' data-id='" . $images . "'>Use this</button>";
                echo "<button class='btn btn-danger deleteIt' data-id='" . $images . "'>Delete this</button>";
                echo "</div>";
                echo "</div>";

                echo "</div>";
                echo "<br><br>";
            }
        }

        echo "
        <script>
        $('.useIt').click(function(){
                
              var image = $(this).attr('data-id');
              $('#imgPreview').attr('src','" . url('/uploads') . "'+'/'+image);
              $('#image').val(image);
              $('#imagetype').prop('checked', true);
              $('#contentListModal').modal('toggle');
         });
         
         $('.deleteIt').click(function(){
             var imageName = $(this).attr('data-id');
             $.ajax({
             type:'POST',
             url:'" . url('/content/delete') . "',
             data:{
                'imageName':imageName             
             },
             success:function(data){
             if(data=='success'){
                $('#'+imageName).hide(200);
                alert('Deleted');
                $('#contentListModal').modal('toggle');
             }else{
              alert(data);
             }
             },
             error:function(data){
             alert('Something went wrong, Please check the console message');
             console.log(data.responseText);
             }
             });
         });
        </script>
        ";

    }

    /**
     * @param Request $request
     * @return string
     */
    public function deleteImage(Request $request)
    {
        $image = $request->imageName;
        try {
            \File::delete(public_path() . "/uploads/" . $image);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function imageSearch(Request $request)
    {
        $data = file_get_contents('https://pixabay.com/api/?key=10761254-2655da71f9b33796d91e0c4cd&q=' . $request->imageQuery . '&image_type=photo');
        $images = json_decode($data, true);
        echo "<br>";
        foreach ($images['hits'] as $image) {
            echo '<a href="#"><img data-url="' . $image['largeImageURL'] . '" class="gg" draggable="true" width="50%" src="' . $image['previewURL'] . '"></a>';
        }

        echo '
        <script>
        $(".gg").click(function() {
            var imageUrl = $(this).attr("data-url")
          $("#pImage").attr("src",imageUrl);
          $("#showImageModal").modal();
          
        })
        </script>

        ';


    }


}
