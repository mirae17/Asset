<?php

namespace App\Helpers;

use App\Models\Family;

class FaraidCalculator
{
    public function calculate($assets, $family)
    {
        $totalValue = $assets->sum('value');
        $distribution = [];
        $fixedShares = 0;

        foreach ($family as $member) {
            $share = 0;
            switch (strtoupper($member->relation)) {
                case 'FATHER':
                    $share = $this->calculateFatherShare($totalValue, $family);
                    break;
                case 'MOTHER':
                    $share = $this->calculateMotherShare($totalValue, $family);
                    break;
                case 'HUSBAND':
                    $share = $this->calculateHusbandShare($totalValue, $family);
                    break;
                case 'WIFE':
                    $share = $this->calculateWifeShare($totalValue, $family);
                    break;
                case 'SON':
                    $share = $this->calculateSonShare($totalValue, $family);
                    break;
                case 'DAUGHTER':
                    $share = $this->calculateDaughterShare($totalValue, $family);
                    break;
                case 'GRANDDAUGHTER':
                    $share = $this->calculateGrandDaughterShare($totalValue, $family);
                    break;
                case 'FULL_SISTER':
                    $share = $this->calculateFullSisterShare($totalValue, $family);
                    break;
                case 'HALF_SISTER':
                    $share = $this->calculateHalfSisterShare($totalValue, $family);
                    break;
                case 'HALF_BROTHER_SISTER':
                    $share = $this->calculateHalfBrotherSisterShare($totalValue, $family);
                    break;
                case 'GRANDFATHER':
                    $share = $this->calculateGrandfatherShare($totalValue, $family);
                    break;
                case 'GRANDMOTHER':
                    $share = $this->calculateGrandmotherShare($totalValue, $family);
                    break;
                case 'HALF_BROTHER':
                    $share = $this->calculateHalfBrotherShare($totalValue, $family);
                    break;
                // Add other cases based on your specific rules
                default:
                    break;
            }

            $fixedShares += $share;
            $distribution[] = [
                'name' => $member->name,
                'relation' => strtoupper($member->relation),
                'share' => $share,
            ];
        }

        // Calculate Asaba shares
        $remainingAssets = $totalValue - $fixedShares;
        if ($remainingAssets > 0) {
            $distribution = $this->distributeAsabaShare($remainingAssets, $distribution, $family);
        }

        return $distribution;
    }

    private function calculateFatherShare($totalValue, $family)
    {
        $hasDescendants = $family->contains(function ($value) {
            return in_array($value->relation, ['SON', 'GRANDSON', 'DAUGHTER', 'GRANDDAUGHTER']);
        });

        if ($hasDescendants) {
            return $totalValue * 0.167; // 1/6th share
        } else {
            return 0; // Father will take as Asaba
        }
    }

    private function calculateMotherShare($totalValue, $family)
    {
        $hasDescendantsOrSiblings = $family->contains(function ($value) {
            return in_array($value->relation, ['SON', 'DAUGHTER', 'GRANDSON', 'GRANDDAUGHTER', 'BROTHER', 'SISTER', 'HALF_BROTHER', 'HALF_SISTER']);
        });

        if ($hasDescendantsOrSiblings) {
            return $totalValue * 0.167; // 1/6th share
        } else {
            return $totalValue * 0.333; // 1/3rd share
        }
    }

    private function calculateHusbandShare($totalValue, $family)
    {
        $hasDescendants = $family->contains(function ($value) {
            return in_array($value->relation, ['SON', 'DAUGHTER', 'GRANDSON', 'GRANDDAUGHTER']);
        });

        if ($hasDescendants) {
            return $totalValue * 0.25; // 1/4th share
        } else {
            return $totalValue * 0.5; // 1/2 share
        }
    }

            private function calculateWifeShare($totalValue, $family)
        {
            $hasSonsOrDaughters = $family->contains(function ($value) {
                return in_array($value->relation, ['SON', 'DAUGHTER','GRANDDAUGHTER','GRANDSON']);
            });

            if ($hasSonsOrDaughters) {
                // JAMINAH has sons or daughters, should get 0.125 share
                $wifeShare = $totalValue * 0.25; // 1/8th share
            } else {
                // JAMINAH has no sons or daughters, should get 0.25 share
                $wifeShare = $totalValue * 0.125; // 1/4th share
            }

            return $wifeShare;
        }

        private function calculateSonShare($totalValue, $family)
        {
            // Sons are Asaba and take remaining assets
            $sonsShare = 0; // Sons are handled in the distributeAsabaShare method
            return $sonsShare;
        }

        private function calculateDaughterShare($totalValue, $family)
        {
            // Daughters are Asaba and take remaining assets
            $daughtersShare = 0; // Daughters are handled in the distributeAsabaShare method
            return $daughtersShare;
        }

    private function calculateGrandDaughterShare($totalValue, $family)
    {
        $hasDaughter = $family->contains(function ($value) {
            return $value->relation == 'DAUGHTER';
        });

        $numGrandDaughters = $family->filter(function ($value) {
            return $value->relation == 'GRANDDAUGHTER';
        })->count();

        if ($numGrandDaughters > 1) {
            return $totalValue * 0.667; // 2/3rd share for 2 or more granddaughters
        } elseif ($hasDaughter) {
            return $totalValue * 0.167; // 1/6th share if has one daughter
        } else {
            return $totalValue * 0.5; // 1/2 share for 1 granddaughter
        }
    }

    private function calculateFullSisterShare($totalValue, $family)
    {
        $numFullSisters = $family->filter(function ($value) {
            return $value->relation == 'FULL_SISTER';
        })->count();

        $hasFatherOrDescendants = $family->contains(function ($value) {
            return in_array($value->relation, ['FATHER', 'GRANDFATHER', 'SON', 'GRANDSON']);
        });

        if ($numFullSisters > 1 && !$hasFatherOrDescendants) {
            return $totalValue * 0.667; // 2/3rd share for 2 or more full-sisters
        } elseif ($numFullSisters == 1 && !$hasFatherOrDescendants) {
            return $totalValue * 0.5; // 1/2 share for 1 full-sister
        } else {
            return 0; // No share if father or descendants exist
        }
    }

    private function calculateHalfSisterShare($totalValue, $family)
    {
        $numHalfSisters = $family->filter(function ($value) {
            return $value->relation == 'HALF_SISTER';
        })->count();

        $hasFatherOrDescendants = $family->contains(function ($value) {
            return in_array($value->relation, ['FATHER', 'GRANDFATHER', 'SON', 'GRANDSON']);
        });

        if ($numHalfSisters > 1 && !$hasFatherOrDescendants) {
            return $totalValue * 0.667; // 2/3rd share for 2 or more half-sisters
        } elseif ($numHalfSisters == 1 && !$hasFatherOrDescendants) {
            return $totalValue * 0.5; // 1/2 share for 1 half-sister
        } else {
            return 0; // No share if father or descendants exist
        }
    }

    private function calculateHalfBrotherSisterShare($totalValue, $family)
    {
        $numHalfBrothersSisters = $family->filter(function ($value) {
            return in_array($value->relation, ['HALF_BROTHER', 'HALF_SISTER']);
        })->count();

        $hasDescendantsOrAscendants = $family->contains(function ($value) {
            return in_array($value->relation, ['FATHER', 'GRANDFATHER', 'SON', 'GRANDSON']);
        });

        if ($numHalfBrothersSisters > 1 && !$hasDescendantsOrAscendants) {
            return $totalValue * 0.333; // 1/3rd share for 2 or more half-brothers/sisters
        } elseif ($numHalfBrothersSisters == 1 && !$hasDescendantsOrAscendants) {
            return $totalValue * 0.167; // 1/6th share for 1 half-brother/sister
        } else {
            return 0; // No share if father or descendants exist
        }
    }

    private function calculateGrandfatherShare($totalValue, $family)
    {
        return $totalValue * 0.167; // 1/6th share
    }

    private function calculateGrandmotherShare($totalValue, $family)
    {
        return $totalValue * 0.167; // 1/6th share
    }

    private function calculateHalfBrotherShare($totalValue, $family)
    {
        return 0; // Half brothers are Asaba and take remaining assets
    }

    private function distributeAsabaShare($remainingAssets, $distribution, $family)
    {
        $totalShares = 0;
        foreach ($family as $member) {
            switch (strtoupper($member->relation)) {
                case 'SON':
                    $totalShares += 2; // Each son gets double the share of a daughter
                    break;
                case 'DAUGHTER':
                    $totalShares += 1; // Each daughter gets a single share
                    break;
                case 'HALF_BROTHER':
                    $totalShares += 1; // Each half-brother gets a single share
                    break;
                // Add other cases for Asaba based on your specific rules
                default:
                    break;
            }
        }

        foreach ($distribution as &$dist) {
            switch (strtoupper($dist['relation'])) {
                case 'SON':
                    $dist['share'] += ($remainingAssets * 2) / $totalShares;
                    break;
                case 'DAUGHTER':
                    $dist['share'] += $remainingAssets / $totalShares;
                    break;
                case 'HALF_BROTHER':
                    $dist['share'] += $remainingAssets / $totalShares;
                    break;
                // Add other cases for Asaba based on your specific rules
                default:
                    break;
            }
        }

        return $distribution;
    }
}

