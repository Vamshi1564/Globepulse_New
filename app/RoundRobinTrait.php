<?php

namespace App;

use App\Models\ProjectRotationModel;
use App\Models\ProjectUserAssignModel;

trait RoundRobinTrait
{
     private function getNextRoundRobinUser($projectId)
    {
        // dd("STEP 1: projectId = ", $projectId);
        // 1) Fetch active users for this project
        $users = ProjectUserAssignModel::where('project_id', $projectId)
            ->where('status', 1)
            ->orderBy('id')
            ->pluck('user_id')
            ->toArray();

        // dd("STEP 2: Users Found = ", $users);
        if (empty($users)) {
            return null;
        }

        // 2) Read rotation table
        $rotation = ProjectRotationModel::where('project_id', $projectId)->first();

        // dd("STEP 3: Rotation Row = ", $rotation);

        if (!$rotation) {
            // First time assigning
            $nextUser = $users[0];

            $create = ProjectRotationModel::create([
                'project_id' => $projectId,
                'last_assigned_user' => $nextUser
            ]);
            // dd("STEP 4: NEW ROTATION CREATED", $create, "NEXT USER = ", $nextUser);

            return $nextUser;
        }

        // 3) Find last user index
        $lastIndex = array_search($rotation->last_assigned_user, $users);

        // dd("STEP 5: lastIndex = ", $lastIndex, "last_user = ", $rotation->last_assigned_user);


        if ($lastIndex === false) {
            $nextUser = $users[0]; // reset
        } else {
            // 4) next index
            $nextIndex = ($lastIndex + 1) % count($users);
            $nextUser = $users[$nextIndex];
        }

        // 5) update last user
        $rotation->update(['last_assigned_user' => $nextUser]);

        // dd("STEP 6: UPDATED ROTATION", $nextUser);

        return $nextUser;
    }
}
