<?php

	//again, change this namespace:
	namespace BoilerplateColumn;
	
	use ChefSections\Columns\DefaultColumn;
	use Cuisine\Wrappers\Field;
	use Cuisine\Utilities\Url;
	
	
	class Column extends DefaultColumn{
	
		/**
		 * The type of column
		 * 
		 * @var String
		 */
		public $type = 'boilerplate';
	
	
		/*=============================================================*/
		/**             Template                                       */
		/*=============================================================*/
	
	
		/**
		 * Start the column template
		 * 
		 * @return string ( html, echoed )
		 */
		public function beforeTemplate(){
	
			//runs before Assets/template.php is presented
		
		}
	
	
	
		/**
		 * Add javascripts to the footer, before the template
		 * and close the div wrapper
		 * 
		 * @return string ( html, echoed )
		 */
		public function afterTemplate(){
	
			//runs after Assets/template.php is presented
			
		}
	
	
		/*=============================================================*/
		/**             Backend                                        */
		/*=============================================================*/
	
		/**
		 * Overwrite the save function for this column
		 * 
		 * @return bool
		 */
		public function saveProperties(){

			$props = $_POST['properties'];

			$saved = update_post_meta( 
				$this->post_id, 
				'_column_props_'.$this->fullId, 
				$props
			);

			//set the new properties in this class
			$this->properties = $props;
			return $saved;
		}
	
		/**
		 * Create the preview for this column
		 * 
		 * @return string (html,echoed)
		 */
		public function buildPreview(){
	
			echo '<strong>'.$this->getField( 'title' ).'</strong>';
	
		}
	
	
		/**
		 * Build the contents of the lightbox for this column
		 * 
		 * @return string ( html, echoed )
		 */
		public function buildLightbox(){
	
			//get all fields for this column
			$fields = $this->getFields();
	
			echo '<div class="main-content">';
			
				foreach( $fields as $field ){
	
					$field->render();
	
					//if a field has a JS-template, we need to render it:
					if( method_exists( $field, 'renderTemplate' ) ){
						echo $field->renderTemplate();
					}
	
				}
	
			echo '</div>';
			echo '<div class="side-content">';
				
				//optional: side fields
	
				$this->saveButton();
	
			echo '</div>';
		}
	
	
		/**
		 * Get the fields for this column
		 * 
		 * @return [type] [description]
		 */
		private function getFields(){
	
			$fields = array(

				'title' => Field::text( 
					'title', 				//id
					'Titel Label',			//label
					
					array(
						'label' 		=> false,	// Show Label false - top - left
						'placeholder' 	=> 'Titel',
						'defaultValue'	=> $this->getField( 'title' ),
					)
				)
				
			);
	
			return $fields;
	
		}
	
	}
	