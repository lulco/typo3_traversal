<?php

class Tx_Traversal_Scheduler_PageTreeRecalculateScheduler extends tx_scheduler_Task
{
	public function execute()
	{
		Tx_Traversal_PageTree::recalculate();
		return true;
	}
}