<?php namespace App\Http\Controllers;

use App\Repositories\ParticipantRepository;

class ParticipantController extends Controller {

  private $participantRepo;

  public function __construct(ParticipantRepository $participantRepo) {
    $this->participantRepo = $participantRepo;
  }

  public function showAll() {
    return response()->json(
      $this->participantRepo->all()
    );
  }
}
