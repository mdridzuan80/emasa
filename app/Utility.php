<?php

namespace App;

use App\Kehadiran;
use Illuminate\Support\Collection;

class Utility
{
    public static function pcrsListerDepartment($SubDepartmentOption, $departmentId)
    {
        return ($SubDepartmentOption == 'true') ? implode(',', array_flatten(SELF::pcrsRelatedDepartment(Department::all(), $departmentId))) : $departmentId;
    }

    public static function pcrsRelatedDepartment(Collection $elements, $parentId = 1)
    {
        $branch = [];

        foreach ($elements as $element) {
            if ((int) $element->supdeptid === (int) $parentId) {
                $branch[] = $element->deptid;
                $c = SELF::pcrsRelatedDepartment($elements, $element->deptid);
                if ($c) {
                    $branch[] = $c;
                }
            }
        }

        array_push($branch, $parentId);

        return $branch;
    }

    public static function PcrsbuildTreeRelated($departments, $parentId = 1, $parentIncId = 0, $branch = [])
    {
        foreach ($departments as $department) {
            $data[] = [
                'id' => $department->deptid,
                'parent' => ($department->supdeptid ? $department->supdeptid : '#'),
                'text' => $department->deptname,
                'state' => [
                    'opened' => ($department->deptid == $parentId) ? true : false,
                    'selected' => ($department->deptid == $parentId) ? true : false
                ]
            ];
        }

        return $data;
    }

    public static function array2object($data)
    {
        if (is_array($data)) {
            $data = (object) $data;
        }

        return $data;
    }

    public static function kesalahanCheckIn($data)
    {
        $kesalahan = json_decode($data, true);

        if (in_array(Kehadiran::FLAG_KESALAHAN_NONEIN, $kesalahan)) {
            return "Tidak Punch-In";
        }

        if (in_array(Kehadiran::FLAG_KESALAHAN_LEWAT, $kesalahan)) {
            return "Datang Awal";
        }
    }

    public static function kesalahanCheckOut($data)
    {
        $kesalahan = json_decode($data, true);

        if (in_array(Kehadiran::FLAG_KESALAHAN_NONEOUT, $kesalahan)) {
            return "Tidak Punch-Out";
        }

        if (in_array(Kehadiran::FLAG_KESALAHAN_AWAL, $kesalahan)) {
            return "Pulang Awal";
        }

        return "-";
    }
}
