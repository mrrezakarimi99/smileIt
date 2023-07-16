<?php

namespace Modules\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Services\CoreService;
use Modules\Core\Traits\CoreApiResponser;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Api Documentation",
 *      description="Swagger",
 *      @OA\Contact(
 *          email="mr.rezakarimi99@gmail.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\PathItem(
 *     path="/api",
 *     description="Core API Endpoints",
 * )
 *
 * @OA\Server(
 *      url="",
 *      description="Development Api Server"
 * )
 *
 * @QAS\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer"
 * )
 *
 */
class CoreController extends Controller
{
    use CoreApiResponser;

    protected ?CoreService $service = null;
}
