<?php

namespace PlanningPoker\Controller;

use PlanningPoker\Library\Flash;
use PlanningPoker\Library\Session;
use PlanningPoker\Library\Text;
use PlanningPoker\Model\Review;

/**
 * Class ReviewController:
 *
 * @package PlanningPoker\Controller
 * @author Florian Drinkler
 */
class ReviewController extends ControllerBase implements Controller
{

    /**
     * Creates a new Review
     * 
     * @access public
     * @example review/create
     * @return void
     * @author Florian Drinkler
     */
    public function createAction()
    {
        $tRet = Review::create($_POST["title"], $_POST["description"], $_POST["rating"]);
        if ($tRet) {
            // TODO: Set Texts
            Flash::success(Text::get("REVIEW_CREATE_SUCCESS"));
        } else {
            Flash::danger(Text::get("REVIEW_CREATE_EXCEPTION"));
        }
    }

    /**
     * Deletes a Review
     * 
     * @access public
     * @example review/delete
     * @return void
     * @author Florian Drinkler
     */
    public function deleteAction()
    {
        $_id = $this->view->basic_params[1];

        $tRet = Review::delete($_id);
        if ($tRet) {
            Flash::success(Text::get("REVIEW_DELETE_SUCCESS"));
        } else {
            Flash::danger(Text::get("REVIEW_DELETE_EXCEPTION"));
        }
    }

    /**
     * Get all reviews
     * 
     * @access public
     * @example review/getAll
     * @return void
     * @author Florian Drinkler
     */
    public function getAllAction()
    {
        $vars = array();

        Review::getAll($vars);

        if (!empty($vars)) {
            $this->view->setVars($vars);
        }
    }
}
