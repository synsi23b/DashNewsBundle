<?php

/*
 * This file is part of the DemoBundle for Kimai 2.
 * All rights reserved by Kevin Papst (www.kevinpapst.de).
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KimaiPlugin\DashNewsBundle\Widget;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Widget\Type\SimpleWidget;
use App\Widget\Type\UserWidget;


class DashNewsWidget extends SimpleWidget implements UserWidget
{
    /**
     * @var UserRepository
     */
    //private $userrep;
    /**
     * @var WerkSheetRepository
     */
    //private $werksheetrep;

    //public function __construct(UserRepository $userrepository, TimesheetRepository $sheetrep, WerkSheetRepository $werkrep)
    public function __construct()
    {
        //$this->userrep = $userrepository;
        //$this->sheetrepo = $sheetrep;
        //$this->werksheetrep = $werkrep;

        $this->setId('DashNewsWidget');
        $this->setTitle('DashNews widget');
        $this->setOptions([
            'user' => null,
            'id' => '',
        ]);
    }

    public function setUser(User $user): void
    {
        $this->setOption('user', $user);
    }

    public function getOptions(array $options = []): array
    {
        $options = parent::getOptions($options);

        if (empty($options['id'])) {
            $options['id'] = 'DashNewsWidget';
        }

        return $options;
    }

    public function getData(array $options = [])
    {
        $options = $this->getOptions($options);
        /** @var User $user */
        $user = $options['user'];

        //$date = date("Y-m-d");

        return [
            'newsrows' => [
                ["2022-10-21", "From this month forward, Worksheets will be locked and exported on the 26th. The remaining days of the month (27 and onward) will be counted during the next cycle."],
                ["2022-10-21", "We are working on calculating Stundents holidays right now, you might have noticed the import of your previous timesheets. You can see your calculated holidays here on the Dashboard soon, after that we will implement the ability to notify about Holidays you plan to take here, too."]
            ]
        ];
    }

    public function getTemplateName(): string
    {
        return '@DashNews/newswidget.html.twig';
    }
}
