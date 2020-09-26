<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedVideo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'featured_videos';

    /**
     * Featured Video relationship to Video Class;
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function video() {
        return $this->belongsTo(Video::class);
    }

}
