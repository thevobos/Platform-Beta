<div class="row" style="margin-bottom: 10px;">

    <div class="col-xl-4">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h3 class="card-title font-size-16 mt-0 text-white">Export</h3>
                <p class="card-text">This feature allows to export all data and management functions..</p>
                <a href="/get/app/export" class="exportButton btn btn-light">Go</a>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h3 class="card-title font-size-16 mt-0 text-white">IMPORT</h3>
                <p class="card-text">This feature allows to import all data and management functions..</p>
                <label style=" margin-bottom: 0px; " for="getFile" class="btn btn-light">Go</label>
                <input accept="application/vobo" id="getFile" type="file" style="opacity:0; position: absolute; width: 1px; height: 1px; overflow: hidden;" >
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h3 class="card-title font-size-16 mt-0 text-white">Language Stabilized</h3>
                <p class="card-text">You can synchronize the modules with the language structure, data entry becomes active with the languages in the structure..</p>
                <div style=" margin-bottom: 0px; "  class=" languageStable btn btn-light">Go</div>
            </div>
        </div>
    </div>

</div>


<?php   $data["define"]["hook"]->do_action("admin@settings");  ?>