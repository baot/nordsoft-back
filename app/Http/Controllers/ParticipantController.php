<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ParticipantRepository;

use Log;

class ParticipantController extends BaseController {

  private $participantRepo;

  public function __construct(ParticipantRepository $participantRepo) {
    $this->participantRepo = $participantRepo;
  }

  public function showAll() {
    return response()->json(
      $this->participantRepo->all()
    );
  }

  public function create(Request $request) {
    $participant = $request->json()->all();
    $newParticipant = $this->participantRepo->create($participant);

    $response = response()->json(
      $newParticipant->toArray()
    );

    return $response;
  }

  public function update(Request $request, $id) {
    $participant = $this->participantRepo->findById($id);

    if (!$participant) {
      return $this->response->errorNotFound();
    }

    $affectRow = $this->participantRepo->update($request->json()->all(), $id);

    if ($affectRow == 1) {
      return response()->json(
        $this->participantRepo->findById($id)->toArray()
      );
    }

    return $this->response->error('Something wrong', 400);
  }

  public function delete($id) {
    $participant = $this->participantRepo->findById($id);

    if (! $participant) {
      return $this->response->errorNotFound();
    }

    $this->participantRepo->delete($id);

    return $this->response->noContent();
  }
}
