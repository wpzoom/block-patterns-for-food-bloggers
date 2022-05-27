/**
 * WordPress dependencies
 */
import { useState } from '@wordpress/element';

/**
 * Internal dependencies
 */
import FoodBlogPatternsSidebar from './sidebar';
import FoodBlogPatternsPreview from './preview';

/**
 * Render the block pattern inserter.
 *
 * @since 0.1.0
 * @param {Object} props All the props passed to this function
 * @return {string}      Return the rendered JSX
 */
export default function FoodBlogPatterns( props ) {
	const {
		allPatterns,
		initialCategory,
		patternCategories,
		patternCategoryTypes,
	} = props;
	const [ selectedCategory, setSelectedCategory ] = useState(
		initialCategory?.name
	);
	const [ searchValue, setSearchValue ] = useState( '' );

	return (
		<div className="block-patterns-for-food-bloggers">
			<FoodBlogPatternsSidebar
				patternCategories={ patternCategories }
				patternCategoryTypes={ patternCategoryTypes }
				selectedCategory={ selectedCategory }
				setSelectedCategory={ setSelectedCategory }
				searchValue={ searchValue }
				setSearchValue={ setSearchValue }
			/>
			<FoodBlogPatternsPreview
				allPatterns={ allPatterns }
				patternCategories={ patternCategories }
				selectedCategory={ selectedCategory }
				searchValue={ searchValue }
			/>
		</div>
	);
}
